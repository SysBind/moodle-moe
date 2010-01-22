// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Comment Helper
 * @author Dongsheng Cai <dongsheng@moodle.com>
 */
// initialize commenting system
M.core_comment = (function(){
    function core_comment (args) {
        core_comment.superclass.constructor.apply(this, arguments);
    }
    core_comment.NAME = "COMMENT";
    core_comment.ATTRS = {
        options: {},
        lang: {}
    };
    Y.extend(core_comment, Y.Base, {
        api: M.cfg.wwwroot+'/comment/comment_ajax.php',
        initializer: function(args) {
            var scope = this;
            this.client_id = args.client_id;
            this.itemid = args.itemid;
            this.commentarea = args.commentarea;
            this.courseid = args.courseid;
            this.contextid = args.contextid;
            if (args.autostart) {
                this.view(args.page);
            }
            if (args.notoggle) {
                Y.one('#comment-link-'+this.client_id).setStyle('display', 'none');
            }
            // load comments
            Y.one('#comment-link-'+this.client_id).on('click', function(e) {
                e.preventDefault();
                this.view(0);
                return false;
            }, this);
            Y.one('#comment-action-cancel'+this.client_id).on('click', function(e) {
                e.preventDefault();
                this.view(0);
                return false;
            }, this);
            // add new comment
            Y.one('#comment-action-post-'+this.client_id).on('click', function(e) {
                e.preventDefault();
                this.post();
                return false;
            }, this);
        },
        post: function() {
            var ta = Y.one('#dlg-content-'+this.client_id);
            var scope = this;
            var value = ta.get('value');
            if (value && value != mstr.moodle.addcomment) {
                this.request({
                    action: 'add',
                    scope: scope,
                    form: {id:'comment-form-'+this.client_id},
                    callback: function(id, obj, args) {
                        var scope = args.scope;
                        var cid = scope.client_id;
                        var ta = Y.one('#dlg-content-'+cid);
                        ta.set('value', '');
                        var container = Y.one('#comment-list-'+cid);
                        var result = scope.render([obj], true);
                        var newcomment = Y.Node.create(result.html);
                        container.appendChild(newcomment);
                        var ids = result.ids;
                        var linktext = Y.one('#comment-link-text-'+cid);
                        linktext.set('innerHTML', mstr.moodle.comments + ' ('+obj.count+')');
                        for(var i in ids) {
                            var attributes = {
                                color: { to: '#06e' },
                                backgroundColor: { to: '#FFE390' }
                            };
                            var anim = new YAHOO.util.ColorAnim(ids[i], attributes);
                            anim.animate();
                        }
                    }
                }, true);
            } else {
                var attributes = {
                    backgroundColor: { from: '#FFE390', to:'#FFFFFF' }
                };
                var anim = new YAHOO.util.ColorAnim('dlg-content-'+cid, attributes);
                anim.animate();
            }
        },
        request: function(args, redraw) {
            var params = {};
            var scope = this;
            if (args['scope']) {
                scope = args['scope'];
            }
            //params['page'] = args.page?args.page:'';
            params['env']       = '';
            // the form element only accept certain file types
            params['sesskey']   = M.cfg.sesskey;
            params['action']    = args.action?args.action:'';
            params['client_id'] = this.client_id;
            params['itemid']    = this.itemid;
            params['area']      = this.commentarea;
            params['courseid']  = this.courseid;
            params['contextid'] = this.contextid;
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
                        var data = json_decode(o.responseText);
                        args.callback(id,data,p);
                    }
                },
                arguments: {
                    scope: scope
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'User-Agent': 'MoodleComment/3.0'
                },
                data: build_querystring(params)
            };
            if (args.form) {
                cfg.form = args.form;
            }
            Y.io(this.api, cfg);
            if (!redraw) {
                this.wait();
            }
        },
        render: function(list, newcmt) {
            var ret = {};
            ret.ids = [];
            var template = Y.one('#cmt-tmpl');
            var html = '';
            for(var i in list) {
                var htmlid = 'comment-'+list[i].id+'-'+this.client_id;
                var val = template.get('innerHTML');
                val = val.replace('___name___', list[i].username);
                if (list[i]['delete']||newcmt) {
                    list[i].content = '<div class="comment-delete"><a href="###" id ="comment-delete-'+this.client_id+'-'+list[i].id+'" title="'+mstr.moodle.deletecomment+'"><img src="'+M.cfg.wwwroot+'/pix/t/delete.gif" /></a></div>' + list[i].content;
                }
                val = val.replace('___time___', list[i].time);
                val = val.replace('___picture___', list[i].avatar);
                val = val.replace('___content___', list[i].content);
                val = '<li id="'+htmlid+'">'+val+'</li>';
                ret.ids.push(htmlid);
                html = (val+html);
            }
            ret.html = html;
            return ret;
        },
        load: function(page) {
            var scope = this;
            var container = Y.one('#comment-ctrl-'+this.client_id);
            var params = {
                'page': page,
            }
            this.request({
                scope: scope,
                params: params,
                callback: function(id, ret, args) {
                    var linktext = Y.one('#comment-link-text-'+scope.client_id);
                    linktext.set('innerHTML', mstr.moodle.comments + ' ('+ret.count+')');
                    var container = Y.one('#comment-list-'+scope.client_id);
                    var pagination = Y.one('#comment-pagination-'+scope.client_id);
                    if (ret.pagination) {
                        pagination.set('innerHTML', ret.pagination);
                    } else {
                        //empty paging bar
                        pagination.set('innerHTML', '');
                    }
                    var result = scope.render(ret.list);
                    container.set('innerHTML', result.html);
                    args.scope.register_pagination();
                    args.scope.register_delete_buttons();
                }
            });
        },
        delete: function(id) {
            var scope = this;
            var params = {'commentid': id};

            function remove_dom(type, anmi, cmt) {
                cmt.remove();
            }
            this.request({
                action: 'delete',
                scope: scope,
                params: params,
                callback: function(id, resp, args) {
                    var htmlid= 'comment-'+resp.commentid+'-'+resp.client_id;
                    var attributes = {
                        width:{to:0},
                        height:{to:0}
                    };
                    var cmt = Y.one('#'+htmlid);
                    cmt.setStyle('overflow', 'hidden');
                    var anim = new YAHOO.util.Anim(htmlid, attributes, 1, YAHOO.util.Easing.easeOut);
                    anim.onComplete.subscribe(remove_dom, cmt, this);
                    anim.animate();
                }
            });
            this.cb = {
                success: function(o) {
                    var resp = json_decode(o.responseText);
                    if (!comment_check_response(resp)) {
                        return;
                    }
                    var htmlid= 'comment-'+resp.commentid+'-'+resp.client_id;
                    this.el = document.getElementById(htmlid);
                    this.el.style.overflow = 'hidden';
                    var attributes = {
                        width:{to:0},
                        height:{to:0}
                    };
                    var anim = new YAHOO.util.Anim(htmlid, attributes, 1, YAHOO.util.Easing.easeOut);
                    anim.onComplete.subscribe(this.remove_dom, [], this);
                    anim.animate();
                },
            }
        },
        register_delete_buttons: function() {
            var scope = this;
            // page buttons
            Y.all('div.comment-content a').each(
                function(node, id) {
                    node.on('click', function(e, node) {
                        var id = node.get('id');
                        var re = new RegExp("comment-delete-"+this.client_id+"-(\\d+)", "i");
                        var result = id.match(re);
                        if (result[1]) {
                            this.delete(result[1]);
                        }
                        //this.load(result[1]);
                    }, scope, node);
                }
            );
        },
        register_pagination: function() {
            var scope = this;
            // page buttons
            Y.all('#comment-paging-'+this.client_id+' a').each(
                function(node, id) {
                    node.on('click', function(e, node) {
                        var id = node.get('id');
                        var re = new RegExp("comment-page-"+this.client_id+"-(\\d+)", "i");
                        var result = id.match(re);
                        this.load(result[1]);
                    }, scope, node);
                }
            );
        },
        view: function(page) {
            var container = Y.one('#comment-ctrl-'+this.client_id);
            var ta = Y.one('#dlg-content-'+this.client_id);
            var img = Y.one('#comment-img-'+this.client_id);
            var d = container.getStyle('display');
            if (d=='none'||d=='') {
                // show
                this.load(page);
                container.setStyle('display', 'block');
                img.src=M.cfg.wwwroot+'/pix/t/expanded.png';
            } else {
                // hide
                container.setStyle('display', 'none');
                img.src=M.cfg.wwwroot+'/pix/t/collapsed.png';
                ta.set('value','');
            }
            //toggle_textarea.apply(ta, [false]);
            //// reset textarea size
            ta.on('click', function() {
                this.toggle_textarea(true);
            }, this)
            //ta.onkeypress = function() {
                //if (this.scrollHeight > this.clientHeight && !window.opera)
                    //this.rows += 1;
            //}
            ta.on('blur', function() {
                this.toggle_textarea(false);
            }, this);
            return false;
        },
        toggle_textarea: function(focus) {
            var t = Y.one('#dlg-content-'+this.client_id);
            if (focus) {
                if (t.get('value') == mstr.moodle.addcomment) {
                    t.set('value', '');
                    t.setStyle('color', 'black');
                }
            }else{
                if (t.get('value') == '') {
                    t.set('value', mstr.moodle.addcomment);
                    t.setStyle('color','grey');
                    t.set('rows', 1);
                }
            }
        },
        wait: function() {
            var container = Y.one('#comment-list-'+this.client_id);
            container.set('innerHTML', '<div style="text-align:center"><img src="'+M.cfg.wwwroot+'/pix/i/loading.gif'+'" /></div>');
        }
    });
    return core_comment;
})();
