// YUI3 File Picker module for moodle
// Author: Dongsheng Cai <dongsheng@moodle.com>

/**
 *
 * File Picker UI
 * =====
 * this.loaded, it tracks if yui2 and yui3 js files loaded
 * this.rendered, it tracks if YUI Panel rendered
 * this.auto_render, tell launch() to render filepicker when all js files are loaded
 * this.api, stores the URL to make ajax request
 * this.loader, yui2 loader
 * this.mainui, YUI Panel
 * this.treeview, YUI Treeview
 * this.viewbar, a button group to switch view mode
 * this.viewmode, store current view mode
 *
 * Filepicker options:
 * =====
 * this.options.pix, stores all images used in file picker
 * this.options.client_id, the instance id
 * this.options.contextid
 * this.options.itemid
 * this.options.repositories, stores all repositories displaied in file picker
 * this.options.formcallback
 *
 * Active repository options
 * =====
 * this.active_repo.id
 * this.active_repo.nosearch
 * this.active_repo.norefresh
 * this.active_repo.nologin
 * this.active_repo.help
 * this.active_repo.manage
 * 
 * Server responses
 * =====
 * this.filelist, cached filelist
 * this.pages
 * this.page
 * this.filepath, current path
 * this.logindata, cached login form
 */

var active_filepicker = null;

YUI.add('filepicker', function(Y) {
    function filepicker (args) {
        filepicker.superclass.constructor.apply(this, arguments);
    }
    filepicker.NAME = "FilePicker";
    filepicker.ATTRS = {
        options: {},
        lang: {}
    };
    filepicker.json_decode = function(string, source) {
        var obj = null;
        try {
            obj = Y.JSON.parse(string);
        } catch(e) {
            alert(mstr.repository.invalidjson+' - |'+source+'| -'+stripHTML(string));
        }
        return obj;
    }
    Y.extend(filepicker, Y.Base, {
        api: moodle_cfg.wwwroot+'/repository/repository_ajax.php',
        initializer: function(args) {
            this.options = args;
            var loader_scope = this;
            this.loaded = false;
            // load yui2 components
            this.loader = new YAHOO.util.YUILoader({
                base: moodle_cfg.yui2loaderBase,
                combine: false,
                comboBase: moodle_cfg.yui2loaderComboBase,
                require: ["button", "container", "treeview", "layout"],
                loadOptional: true,
                onSuccess: function(o) {
                    loader_scope.loaded = true;
                    if (loader_scope.auto_render) {
                        loader_scope.render();
                    }
                },
                onProgress: function(o) {
                }
            });
            this.loader.insert();
        },
        destructor: function() {
        },
        request: function(args, redraw) {
            var api = this.api + '?action='+args.action;
            var params = {};
            var scope = this;
            if (args['scope']) {
                scope = args['scope'];
            }
            params['repo_id']=args.repository_id;
            params['p'] = args.path?args.path:'';
            params['page'] = args.page?args.page:'';
            params['env']=this.options.env;
            // the form element only accept certain file types
            params['accepted_types']=this.options.accepted_types;
            params['sesskey']=moodle_cfg.sesskey;
            params['client_id'] = args.client_id;
            params['itemid'] = this.itemid?this.itemid:0;
            if (args['params']) {
                for (i in args['params']) {
                    params[i] = args['params'][i];
                }
            }
            var cfg = {
                method: 'POST',
                on: {
                    complete: function(id,o,p) {
                        if (!o) {
                            alert('IO FATAL');
                            return;
                        }
                        var data = filepicker.json_decode(o.responseText);
                        args.callback(id,data,p);
                    }
                },
                arguments: {
                    scope: scope
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'User-Agent': 'MoodleFilePicker/3.0'
                },
                data: build_querystring(params)
            };
            if (args.form) {
                cfg.form = args.form;
            }
            Y.io(api, cfg);
            if (redraw) {
                this.wait('load');
            }
        },
        build_tree: function(node, level) {
            var client_id = this.options.client_id;
            if(node.children) {
                node.title = '<i><u>'+node.title+'</u></i>';
            }
            var info = {
                label:node.title,
                //title:fp_lang.date+' '+node.date+fp_lang.size+' '+node.size,
                filename:node.title,
                source:node.source?node.source:'',
                thumbnail:node.thumbnail,
                path:node.path?node.path:[]
            };
            var tmpNode = new YAHOO.widget.TextNode(info, level, false);
            //var tooltip = new YAHOO.widget.Tooltip(tmpNode.labelElId, {
                //context:tmpNode.labelElId, text:info.title});
            if(node.repo_id) {
                tmpNode.repo_id=node.repo_id;
            }else{
                tmpNode.repo_id=this.active_repo.id;
            }
            if(node.children) {
                if(node.expanded) {
                    tmpNode.expand();
                }
                tmpNode.isLeaf = false;
                tmpNode.client_id = client_id;
                if (node.path) {
                    tmpNode.path = node.path;
                } else {
                    tmpNode.path = '';
                }
                for(var c in node.children) {
                    this.build_tree(node.children[c], tmpNode);
                }
            } else {
                tmpNode.isLeaf = true;
            }
        },
        view_files: function() {
            this.viewbar.set('disabled', false);
            if (this.viewmode == 1) {
                this.view_as_icons();
            } else if (this.viewmode ==2) {
                this.view_as_list();
            } else {
                this.view_as_icons();
            }
        },
        view_as_list: function() {
            var client_id = this.options.client_id;
            var list = this.filelist;
            var panel_id = '#panel-'+client_id;
            this.viewmode = 2;
            Y.one(panel_id).set('innerHTML', '');

            this.print_header();
            var tree = Y.Node.create('<div id="treeview-'+client_id+'"></div>');
            Y.one(panel_id).appendChild(tree);
            this.treeview = new YAHOO.widget.TreeView('treeview-'+client_id);

            for(k in list) {
                this.build_tree(list[k], this.treeview.getRoot());
            }
            var scope = this;
            this.treeview.subscribe('clickEvent', function(e){
                if(e.node.isLeaf){
                    var fileinfo = {};
                    fileinfo['title'] = e.node.data.filename;
                    fileinfo['source'] = e.node.data.source;
                    fileinfo['thumbnail'] = e.node.data.thumbnail;
                    scope.select_file(fileinfo);
                }
            });
            this.treeview.draw();
        },
        view_as_icons: function() {
            var client_id = this.options.client_id;
            var list = this.filelist;
            var panel_id = '#panel-'+client_id;
            this.viewmode = 1;
            Y.one(panel_id).set('innerHTML', '');

            this.print_header();

            var gridpanel = Y.Node.create('<div id="fp-grid-panel-'+client_id+'"></div>');
            Y.one('#panel-'+client_id).appendChild(gridpanel);
            var count = 0;
            for(var k in list) {
                var node = list[k];
                var grid = document.createElement('DIV');
                grid.className='fp-grid';
                // the file name
                var title = document.createElement('DIV');
                title.id = 'grid-title-'+client_id+'-'+String(count);
                title.className = 'label';
                if (node.shorttitle) {
                    node.title = node.shorttitle;
                }
                title.innerHTML += '<a href="###"><span>'+node.title+"</span></a>";

                if(node.thumbnail_width){
                    grid.style.width = node.thumbnail_width+'px';
                    title.style.width = (node.thumbnail_width-10)+'px';
                } else {
                    grid.style.width = title.style.width = '90px';
                }
                var frame = document.createElement('DIV');
                frame.style.textAlign='center';
                if(node.thumbnail_height){
                    frame.style.height = node.thumbnail_height+'px';
                }
                var img = document.createElement('img');
                img.src = node.thumbnail;
                if(node.thumbnail_alt) {
                    img.alt = node.thumbnail_alt;
                }
                if(node.thumbnail_title) {
                    img.title = node.thumbnail_title;
                }

                var link = document.createElement('A');
                link.href='###';
                link.id = 'img-id-'+client_id+'-'+String(count);
                if(node.url) {
                    // hide 
                    //grid.innerHTML += '<p><a target="_blank" href="'+node.url+'">'+mstr.repository.preview+'</a></p>';
                }
                link.appendChild(img);
                frame.appendChild(link);
                grid.appendChild(frame);
                grid.appendChild(title);
                gridpanel.appendChild(grid);

                var y_title = Y.one('#'+title.id);
                var y_file = Y.one('#'+link.id);
                if(node.children) {
                    y_file.on('click', function(e, p) {
                        if(p.dynload) {
                            var params = {};
                        }else{
                            this.filelist = p.children;
                            this.view_files();
                        }
                    }, this, node);
                    y_title.on('click', function(e, p){
                        //Y.Event.simulate(y_file, 'click');
                    }, this, node);
                } else {
                    var fileinfo = {};
                    fileinfo['title'] = list[k].title;
                    fileinfo['source'] = list[k].source;
                    fileinfo['thumbnail'] = list[k].thumbnail;
                    y_title.on('click', function(e, args) {
                        this.select_file(args);
                    }, this, fileinfo);
                    y_file.on('click', function(e, args) {
                        this.select_file(args);
                    }, this, fileinfo);
                }
                count++;
            }
            //if (list.length == 0 && !this.upload) {
                //panel.innerHTML = '<div class="fp-error">'+mstr.repository.emptylist+'</div>';
            //}
            //container.appendChild(panel);
            //repository_client.print_footer(client_id);
        },
        select_file: function(args) {
            var client_id = this.options.client_id;
            var thumbnail = Y.one('#fp-grid-panel-'+client_id);
            if(thumbnail){
                thumbnail.setStyle('display', 'none');
            }
            var header = Y.one('#fp-header-'+client_id);
            if (header) {
                header.setStyle('display', 'none');
            }
            var footer = Y.one('#fp-footer-'+client_id);
            if (footer) {
                footer.setStyle('display', 'none');
            }
            var path = Y.one('#path-'+client_id);
            if(path){
                path.setStyle('display', 'none');
            }
            var panel = Y.one('#panel-'+client_id);
            var html = '<div class="fp-rename-form">';
            html += '<p><img src="'+args.thumbnail+'" /></p>';
            html += '<p><label for="newname-'+client_id+'">'+mstr.repository.saveas+'</label>';
            html += '<input type="text" id="newname-'+client_id+'" value="'+args.title+'" /></p>';

            var le_checked = '';
            var le_style = '';
            if (this.options.repositories[this.active_repo.id].return_types == 1) {
                // support external links only
                le_checked = 'checked';
                le_style = ' style="display:none;"';
            } else if(this.options.repositories[this.active_repo.id].return_types == 2) {
                // support internal files only
                le_style = ' style="display:none;"';
            }
            if (this.options.externallink && this.options.env == 'editor') {
                html += '<p'+le_style+'><input type="checkbox" id="linkexternal-'+client_id+'" value="" '+le_checked+' />'+mstr.repository.linkexternal+'</p>';
            }
            html += '<p><input type="hidden" id="filesource-'+client_id+'" value="'+args.source+'" />';
            html += '<input type="button" id="fp-confirm-'+client_id+'" value="'+mstr.repository.getfile+'" />';
            html += '<input type="button" id="fp-cancel-'+client_id+'" value="'+mstr.moodle.cancel+'" /></p>';
            html += '</div>';

            var getfile_form = Y.Node.create(html);
            panel.appendChild(getfile_form);

            var getfile = Y.one('#fp-confirm-'+client_id);
            getfile.on('click', function(e) {
                var client_id = this.options.client_id;
                var scope = this;
                var repository_id = this.active_repo.id;
                var title = Y.one('#newname-'+client_id).get('value');
                var filesource = Y.one('#filesource-'+client_id).get('value');
                var params = {'title':title, 'file':filesource};

                if (this.options.env == 'editor') {
                    var linkexternal = Y.one('#linkexternal-'+client_id).get('checked');
                    if (linkexternal) {
                        params['linkexternal'] = 'yes';
                    }
                } if (this.options.env == 'url') {
                    params['linkexternal'] = 'yes';
                }

                this.wait('download', title);
                this.request({
                        action:'download',
                        client_id: client_id,
                        repository_id: repository_id,
                        'params': params,
                        callback: function(id, obj, args) {
                            if (scope.options.editor_target&&scope.options.env=='editor') {
                                scope.options.editor_target.value=obj.url;
                                scope.options.editor_target.onchange();
                            }
                            scope.hide();
                            scope.options.formcallback(obj);
                        }
                }, true);
            }, this);
            var cancel = Y.one('#fp-cancel-'+client_id);
            cancel.on('click', function(e) {
                this.view_files();
            }, this);
            var treeview = Y.one('#treeview-'+client_id);
            if (treeview){
                treeview.setStyle('display', 'none');
            }
        },
        wait: function(type) {
            var panel = Y.one('#panel-'+this.options.client_id);
            panel.set('innerHTML', '');
            var name = '';
            var str = '<div style="text-align:center">';
            if(type=='load') {
                str += '<img src="'+this.options.pix.loading+'" />';
                str += '<p>'+mstr.repository.loading+'</p>';
            }else{
                str += '<img src="'+this.options.pix.progressbar+'" />';
                str += '<p>'+mstr.repository.copying+' <strong>'+name+'</strong></p>';
            }
            str += '</div>';
            try {
                panel.set('innerHTML', str);
            } catch(e) {
                alert(e.toString());
            }
        },
        render: function() {
            var client_id = this.options.client_id;
            var filepicker_id = 'filepicker-'+client_id;
            var fpnode = Y.Node.create('<div class="file-picker" id="'+filepicker_id+'"></div>');
            Y.one(document.body).appendChild(fpnode);
            // render file picker panel
            this.mainui = new YAHOO.widget.Panel(filepicker_id, {
                draggable: true,
                close: true,
                underlay: 'none',
                zindex: 9999999,
                monitorresize: false,
                xy: [50, YAHOO.util.Dom.getDocumentScrollTop()+20]
            });
            var layout = null;
            this.mainui.beforeRenderEvent.subscribe(function() {
                YAHOO.util.Event.onAvailable('layout-'+client_id, function() {
                    layout = new YAHOO.widget.Layout('layout-'+client_id, {
                        height: 480, width: 700,
                        units: [
                        {position: 'top', height: 32, resize: false,
                        body:'<div class="yui-buttongroup fp-viewbar" id="fp-viewbar-'+client_id+'"></div><div class="fp-searchbar" id="search-div-'+client_id+'"></div>', gutter: '2'},
                        {position: 'left', width: 200, resize: true, scroll:true,
                        body:'<ul class="fp-list" id="fp-list-'+client_id+'"></ul>', gutter: '0 5 0 2', minWidth: 150, maxWidth: 300 },
                        {position: 'center', body: '<div class="fp-panel" id="panel-'+client_id+'"></div>',
                        scroll: true, gutter: '0 2 0 0' }
                        ]
                    });
                    layout.render();
                });
            });
            this.mainui.setHeader('File Picker');
            this.mainui.setBody('<div id="layout-'+client_id+'"></div>');
            this.mainui.render();
            this.rendered = true;

            var scope = this;
            // adding buttons
            var view_icons = {label: mstr.repository.iconview, value: 't',
                onclick: {
                    fn: function(){
                        scope.view_as_icons();
                    }
                }
            };
            var view_listing = {label: mstr.repository.listview, value: 'l',
                onclick: {
                    fn: function(){
                        scope.view_as_list();
                    }
                }
            };
            this.viewbar = new YAHOO.widget.ButtonGroup({
                id: 'btngroup-'+client_id,
                name: 'buttons',
                disabled: true,
                container: 'fp-viewbar-'+client_id
            });
            this.viewbar.addButtons([view_icons, view_listing]);
            // processing repository listing
            var r = this.options.repositories;
            Y.on('contentready', function(el) {
                var list = Y.one(el);
                var count = 0;
                for (var i in r) {
                    var id = 'repository-'+client_id+'-'+count;
                    var link_id = id + '-link';
                    list.append('<li id="'+id+'"><a class="fp-repo-name" id="'+link_id+'" href="###">'+r[i].name+'</a></li>');
                    Y.one('#'+link_id).prepend('<img src="'+r[i].icon+'" width="16" height="16" />&nbsp;');
                    Y.one('#'+link_id).on('click', function(e, scope, repository_id) {
                        scope.repository_id = repository_id;
                        Y.all(el+' li a').setStyle('backgroundColor', 'transparent');
                        e.currentTarget.setStyle('backgroundColor', '#CCC');
                        this.list({'repo_id':repository_id});
                    }, this /*handler running scope*/, this/*second argument*/, r[i].id/*third argument of handler*/);
                    count++;
                }
            }, '#fp-list-'+client_id, this /* handler running scope */, '#fp-list-'+client_id /*first argument of handler*/);
        },
        parse_repository_options: function(data) {
            this.filelist = data.list?data.list:null;
            this.filepath = data.path?data.path:null;
            this.active_repo = {};
            this.active_repo.issearchresult = Boolean(data.issearchresult);
            this.active_repo.pages = Number(data.pages?data.pages:null);
            this.active_repo.page = Number(data.page?data.page:null);
            this.active_repo.id = data.repo_id?data.repo_id:null;
            this.active_repo.nosearch = data.nosearch?true:false;
            this.active_repo.norefresh = data.norefresh?true:false;
            this.active_repo.nologin = data.nologin?true:false;
            this.active_repo.help = data.help?data.help:null;
            this.active_repo.manage = data.manage?data.manage:null;
        },
        print_login: function(data) {
            var client_id = this.options.client_id;
            var repository_id = data.repo_id;
            var l = this.logindata = data.login;
            var loginurl = '';
            var panel = Y.one('#panel-'+client_id);
            var action = 'login';
            if (data['login_btn_action']) {
                action=data['login_btn_action'];
            }
            var form_id = 'fp-form-'+client_id;
            var download_button_id = 'fp-form-download-button-'+client_id;
            var search_button_id   = 'fp-form-search-button-'+client_id;
            var login_button_id    = 'fp-form-login-button-'+client_id;
            var popup_button_id    = 'fp-form-popup-button-'+client_id;

            var str = '<div class="fp-login-form">';
            str += '<form id="'+form_id+'">';
            var has_pop = false;
            str +='<table width="100%">';
            for(var k in l) {
                str +='<tr>';
                if(l[k].type=='popup') {
                    // pop element
                    loginurl = l[k].url;
                    str += '<td colspan="2"><p class="fp-popup">'+mstr.repository.popup+'</p>';
                    str += '<p class="fp-popup"><button id="'+popup_button_id+'">'+mstr.repository.login+'</button>';
                    str += '</p></td>';
                    action = 'popup';
                }else if(l[k].type=='textarea') {
                    // textarea element
                    str += '<td colspan="2"><p><textarea id="'+l[k].id+'" name="'+l[k].name+'"></textarea></p></td>';
                }else if(l[k].type=='select') {
                    // select element
                    str += '<td align="right"><label>'+l[k].label+':</label></td>';
                    str += '<td align="left"><select id="'+l[k].id+'" name="'+l[k].name+'">';
                    for (i in l[k].options) {
                        str += '<option value="'+l[k].options[i].value+'">'+l[k].options[i].label+'</option>';
                    }
                    str += '</select></td>';
                }else{
                    // input element
                    var label_id = '';
                    var field_id = '';
                    var field_value = '';
                    if(l[k].id) {
                        label_id = ' for="'+l[k].id+'"';
                        field_id = ' id="'+l[k].id+'"';
                    }
                    if (l[k].label) {
                        str += '<td align="right" width="30%" valign="center">';
                        str += '<label'+label_id+'>'+l[k].label+'</label> </td>';
                    } else {
                        str += '<td width="30%"></td>';
                    }
                    if(l[k].value) {
                        field_value = ' value="'+l[k].value+'"';
                    }
                    if(l[k].type=='radio'){
                        var list = l[k].value.split('|');
                        var labels = l[k].value_label.split('|');
                        str += '<td align="left">';
                        for(var item in list) {
                            str +='<input type="'+l[k].type+'"'+' name="'+l[k].name+'"'+
                                field_id+' value="'+list[item]+'" />'+labels[item]+'<br />';
                        }
                        str += '</td>';
                    }else{
                        str += '<td align="left">';
                        str += '<input type="'+l[k].type+'"'+' name="'+l[k].name+'"'+field_value+' '+field_id+' />';
                        str += '</td>';
                    }
                }
                str +='</tr>';
            }
            str +='</table>';
            str += '</form>';

            // custom lable text
            var btn_label = data['login_btn_label']?data['login_btn_label']:mstr.repository.submit;
            if (action != 'popup') {
                str += '<p><input type="button" id="';
                switch (action) {
                    case 'search':
                        str += search_button_id;
                        break;
                    case 'download':
                        str += download_button_id;
                        break;
                    default:
                        str += login_button_id;
                        break;
                }
                str += '" value="'+btn_label+'" /></p>';
            }

            str += '</div>';

            // insert login form
            try {
                panel.set('innerHTML', str);
            } catch(e) {
                alert(e.toString()+mstr.quiz.xhtml);
            }
            // register buttons
            // process login action
            var login_button = Y.one('#'+login_button_id);
            var scope = this;
            if (login_button) {
                login_button.on('click', function(){
                    // collect form data
                    var data = this.logindata;
                    var scope = this;
                    var params = {};
                    for (var k in data) {
                        if(data[k].type!='popup') {
                            var el = Y.one('[name='+data[k].name+']');
                            var type = el.get('type');
                            params[data[k].name] = '';
                            if(type == 'checkbox') {
                                params[data[k].name] = el.get('checked');
                            } else {
                                params[data[k].name] = el.get('value');
                            }
                        }
                    }
                    // start ajax request
                    this.request({
                        'params': params,
                        'scope': scope,
                        'action':'signin',
                        'path': '',
                        'client_id': client_id,
                        'repository_id': repository_id,
                        'callback': function(id, o, args) {
                            scope.parse_repository_options(o);
                            scope.view_files();
                            if (o.msg) {
                                // do something
                            }
                        }
                    }, true);
                }, this);
            }
            var search_button = Y.one('#'+search_button_id);
            if (search_button) {
                search_button.on('click', function(){
                    var data = this.logindata;
                    var params = {};

                    for (var k in data) {
                        if(data[k].type!='popup') {
                            var el = document.getElementsByName(data[k].name)[0];
                            params[data[k].name] = '';
                            if(el.type == 'checkbox') {
                                params[data[k].name] = el.checked;
                            } else if(el.type == 'radio') {
                                var tmp = document.getElementsByName(data[k].name);
                                for(var i in tmp) {
                                    if (tmp[i].checked) {
                                        params[data[k].name] = tmp[i].value;
                                    }
                                }
                            } else {
                                params[data[k].name] = el.value;
                            }
                        }
                    }
                    this.request({
                            scope: scope,
                            action:'search',
                            client_id: client_id,
                            repository_id: repository_id,
                            form: {id: 'fp-form-'+scope.options.client_id,upload:false,useDisabled:true},
                            callback: function(id, o, args) {
                                o.issearchresult = true;
                                scope.parse_repository_options(o);
                                scope.view_files();
                            }
                    }, true);
                }, this);
            }
            var download_button = Y.one('#'+download_button_id);
            if (download_button) {
                download_button.on('click', function(){
                    alert('download');
                });
            }
            var popup_button = Y.one('#'+popup_button_id);
            if (popup_button) {
                popup_button.on('click', function(){
                    window.open(loginurl, 'repo_auth', 'location=0,status=0,scrollbars=0,width=500,height=300');
                    active_filepicker = this;
                }, this);
            }

        },
        search: function(args) {
            var data = this.logindata;
            var params = {};

            for (var k in data) {
                if(data[k].type!='popup') {
                    var el = document.getElementsByName(data[k].name)[0];
                    params[data[k].name] = '';
                    if(el.type == 'checkbox') {
                        params[data[k].name] = el.checked;
                    } else if(el.type == 'radio') {
                        var tmp = document.getElementsByName(data[k].name);
                        for(var i in tmp) {
                            if (tmp[i].checked) {
                                params[data[k].name] = tmp[i].value;
                            }
                        }
                    } else {
                        params[data[k].name] = el.value;
                    }
                }
            }
            this.request({
                    scope: scope,
                    action:'search',
                    client_id: client_id,
                    repository_id: repository_id,
                    form: {id: 'fp-form-'+scope.options.client_id,upload:false,useDisabled:true},
                    callback: function(id, o, args) {
                        o.issearchresult = true;
                        scope.parse_repository_options(o);
                        scope.view_files();
                    }
            }, true);
        },
        list: function(args) {
            var scope = this;
            if (!args) {
                args = {};
            }
            if (!args.repo_id) {
                args.repo_id = scope.active_repo.id;
            }
            scope.request({
                action:'list',
                client_id: scope.options.client_id,
                repository_id: args.repo_id,
                path:args.path?args.path:'',
                page:args.page?args.page:'',
                callback: function(id, obj, args) {
                    if (obj.login) {
                        scope.viewbar.set('disabled', true);
                        scope.print_login(obj);
                    } else if (obj.upload) {
                        scope.viewbar.set('disabled', true);
                        scope.parse_repository_options(obj);
                        scope.create_upload_form(obj);
                    
                    } else if (obj.iframe) {

                    } else if (obj.list) {
                        obj.issearchresult = false;
                        scope.viewbar.set('disabled', false);
                        scope.parse_repository_options(obj);
                        scope.view_files();
                    }
                    if (obj.msg) {
                        // TODO: Print message
                    }
                }
            }, true);
        },
        create_upload_form: function(data) {
            var client_id = this.options.client_id;
            Y.one('#panel-'+client_id).set('innerHTML', '');

            this.print_header();
            var id = data.upload.id+'_'+client_id;
            var str = '<div id="'+id+'_div" class="fp-upload-form">';
            str += '<form id="'+id+'" onsubmit="return false">';
            str += '<label for="'+id+'_file">'+data.upload.label+': </label>';
            str += '<input type="file" id="'+id+'_file" name="repo_upload_file" />';
            str += '<div class="fp-upload-btn"><a id="'+id+'_action" href="###" >'+mstr.repository.upload+'</a></div>';
            str += '</form>';
            str += '</div>';
            var upload_form = Y.Node.create(str);
            Y.one('#panel-'+client_id).appendChild(upload_form);
            var scope = this;
            Y.one('#'+id+'_action').on('click', function() {
                alert('FAIL');
                //this.request({
                        //scope: scope,
                        //action:'upload',
                        //client_id: client_id,
                        //repository_id: scope.options.active_repo.id,
                        //form: {id: 'fp-search-form',upload:true,useDisabled:true},
                        //callback: function(id, o, args) {
                        //}
                //}, true);
            }, this);
        },
        print_header: function() {
            var r = this.active_repo;
            var scope = this;
            var client_id = this.options.client_id;
            var repository_id = this.active_repo.id;
            var panel = Y.one('#panel-'+client_id);
            var str = '<div id="fp-header-'+client_id+'">';
            str += '<div class="fp-toolbar" id="repo-tb-'+client_id+'"></div>';
            str += '</div>';
            var head = Y.Node.create(str);
            panel.appendChild(head);
            //if(this.active_repo.pages < 8){
                this.print_paging('header');
            //}


            var toolbar = Y.one('#repo-tb-'+client_id);

            if(!r.nosearch) {
                var html = '<a href="###"><img src="'+this.options.pix.search+'" /> '+mstr.repository.search+'</a>';
                var search = Y.Node.create(html);
                search.on('click', function() {
                    scope.request({
                        scope: scope,
                        action:'searchform',
                        repository_id: repository_id,
                        callback: function(id, obj, args) {
                            var scope = args.scope;
                            var client_id = scope.options.client_id;
                            var repository_id = scope.active_repo.id;
                            var container = document.getElementById('fp-search-dlg');
                            if(container) {
                                container.innerHTML = '';
                                container.parentNode.removeChild(container);
                            }
                            var container = document.createElement('DIV');
                            container.id = 'fp-search-dlg';

                            var dlg_title = document.createElement('DIV');
                            dlg_title.className = 'hd';
                            dlg_title.innerHTML = 'filepicker';

                            var dlg_body = document.createElement('DIV');
                            dlg_body.className = 'bd';

                            var sform = document.createElement('FORM');
                            sform.method = 'POST';
                            sform.id = "fp-search-form";
                            sform.innerHTML = obj.form;

                            dlg_body.appendChild(sform);
                            container.appendChild(dlg_title);
                            container.appendChild(dlg_body);
                            Y.one(document.body).appendChild(container);
                            var search_dialog= null;
                            function dialog_handler() {
                                scope.viewbar.set('disabled', false);
                                scope.request({
                                        scope: scope,
                                        action:'search',
                                        client_id: client_id,
                                        repository_id: repository_id,
                                        form: {id: 'fp-search-form',upload:false,useDisabled:true},
                                        callback: function(id, o, args) {
                                            scope.parse_repository_options(o);
                                            scope.view_files();
                                        }
                                }, true);
                                search_dialog.cancel();
                            }

                            var search_dialog = new YAHOO.widget.Dialog("fp-search-dlg", {
                               postmethod: 'async',
                               draggable: true,
                               width : "30em",
                               fixedcenter : true,
                               zindex: 766667,
                               visible : false,
                               constraintoviewport : true,
                               buttons: [
                               {
                                   text:mstr.repository.submit,
                                   handler:dialog_handler,
                                   isDefault:true
                               }, {
                                   text:mstr.moodle.cancel,
                                   handler:function(){
                                       this.destroy()
                                   }
                               }]
                            });
                            search_dialog.render();
                            search_dialog.show();
                        }
                    });
                },this);
                toolbar.appendChild(search);
            }
            // weather we use cache for this instance, this button will reload listing anyway
            if(!r.norefresh) {
                var html = '<a href="###"><img src="'+this.options.pix.refresh+'" /> '+mstr.repository.refresh+'</a>';
                var refresh = Y.Node.create(html);
                refresh.on('click', function() {
                    this.list();
                }, this);
                toolbar.appendChild(refresh);
            }
            if(!r.nologin) {
                var html = '<a href="###"><img src="'+this.options.pix.logout+'" /> '+mstr.repository.logout+'</a>';
                var logout = Y.Node.create(html);
                logout.on('click', function() {
                    this.request({
                        action:'logout',
                        client_id: client_id,
                        repository_id: repository_id,
                        path:'',
                        callback: function(id, obj, args) {
                            scope.viewbar.set('disabled', true);
                            scope.print_login(obj);
                        }
                    }, true);
                }, this);
                toolbar.appendChild(logout);
            }

            if(r.manage) {
                var mgr = document.createElement('A');
                mgr.href = r.manage;
                mgr.target = "_blank";
                mgr.innerHTML = '<img src="'+this.options.pix.setting+'" /> '+mstr.repository.manageurl;
                toolbar.appendChild(mgr);
            }
            if(r.help) {
                var help = document.createElement('A');
                help.href = r.help;
                help.target = "_blank";
                help.innerHTML = '<img src="'+this.options.pix.help+'" /> '+mstr.repository.help;
                toolbar.appendChild(help);
            }

            // only show in icons view
            if (this.viewmode == 1) {
                this.print_path();
            }
        },
        get_page_button: function(page) {
            var r = this.active_repo;
            var css = '';
            if (page == r.page) {
                css = 'class="cur_page" ';
            }
            var str = '<a '+css+'href="###" id="repo-page-'+page+'">';
            return str;
        },
        print_paging: function(html_id) {
            var client_id = this.options.client_id;
            var scope = this;
            var r = this.active_repo;
            var str = '';
            var action = '';
            if(r.pages) {
                str += '<div class="fp-paging" id="paging-'+html_id+'-'+client_id+'">';
                str += this.get_page_button(1)+'1</a> ';

                var span = 5;
                var ex = (span-1)/2;

                if (r.page+ex>=r.pages) {
                    var max = r.pages;
                } else {
                    if (r.page<span) {
                        var max = span;
                    } else {
                        var max = r.page+ex;
                    }
                }

                // won't display upper boundary
                if (r.page >= span) {
                    str += ' ... ';
                    for(var i=r.page-ex; i<max; i++) {
                        str += this.get_page_button(i);
                        str += String(i);
                        str += '</a> ';
                    }
                } else {
                    // this very first elements
                    for(var i = 2; i < max; i++) {
                        str += this.get_page_button(i);
                        str += String(i);
                        str += '</a> ';
                    }
                }

                // won't display upper boundary
                if (max==r.pages) {
                    str += this.get_page_button(r.pages)+r.pages+'</a>';
                } else {
                    str += this.get_page_button(max)+max+'</a>';
                    str += ' ... '+this.get_page_button(r.pages)+r.pages+'</a>';
                }
                str += '</div>';
            }
            if (str) {
                var a = Y.Node.create(str);
                Y.one('#fp-header-'+client_id).appendChild(a);

                Y.all('#fp-header-'+client_id+' .fp-paging a').each(
                    function(node, id) {
                        node.on('click', function(e) {
                            var id = node.get('id');
                            var re = new RegExp("repo-page-(\\d+)", "i");
                            var result = id.match(re);
                            var args = {};
                            args.page = result[1];
                            if (scope.active_repo.issearchresult) {
                                scope.request({
                                        scope: scope,
                                        action:'search',
                                        client_id: client_id,
                                        repository_id: r.id,
                                        params: {'page':result[1]},
                                        callback: function(id, o, args) {
                                            o.issearchresult = true;
                                            scope.parse_repository_options(o);
                                            scope.view_files();
                                        }
                                }, true);

                            } else {
                                scope.list(args);
                            }
                        });
                    });
            }
        },
        print_path: function() {
            var client_id = this.options.client_id;
            if (this.viewmode == 2) {
                return;
            }
            var panel = Y.one('#panel-'+client_id);
            var p = this.filepath;
            if(p && p.length!=0) {
                var path = Y.Node.create('<div id="path-'+client_id+'" class="fp-pathbar"></div>');
                panel.appendChild(path);
                for(var i = 0; i < p.length; i++) {
                    var link = document.createElement('A');
                    link.href = "###";
                    link.innerHTML = p[i].name;
                    //link.id = 'path-'+client_id+'-'+repo_id;
                    var sep = Y.Node.create('<span>/</span>');
                    
                    path.appendChild(link);
                    path.appendChild(sep);
                }
            }
        },
        hide: function() {
            this.mainui.hide();
        },
        show: function() {
            if (this.rendered) {
                var panel = Y.one('#panel-'+this.options.client_id);
                panel.set('innerHTML', '');
                this.mainui.show();
            } else {
                this.launch();
            }
        },
        launch: function() {
            if (this.loaded) {
                this.render();
            } else {
                this.auto_render = true;
            }
        }
    });
    Y.filepicker = filepicker;
}, '3.0.0', {requires:['base', 'node', 'json', 'async-queue', 'io']});
