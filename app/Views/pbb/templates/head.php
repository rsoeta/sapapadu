<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- <meta content='text/html; charset=UTF-8' http-equiv='Content-Type' />
    <meta name='MSSmartTagsPreventParsing' content='true' /> -->
    <!-- <meta name='ROBOTS' content='INDEX, FOLLOW' />
    <meta name='Distribution' content='Global' />
    <meta name='spiders' content='follow, all' />
    <meta name='webcrawlers' content='follow, all' />
    <meta name='googlebot' content='follow, all, index' />
    <meta name='Googlebot-Image' content='follow, all, index' />
    <meta name='Scooter' content='follow, all' />
    <meta name='msnbot' content='follow, all' />
    <meta name='Slurp' content='follow, all' />
    <meta name='ZyBorg' content='follow, all' />
    <meta name='revisit-after' content='2 days' />
    <meta name='yahoobot' content='all, index, follow' />
    <meta name='bingbot' content='all, index, follow' />
    <meta name='language' content='id' />
    <meta name='geo.country' content='id' />
    <meta name='geo.placename' content='Indonesia' />
    <meta name='rating' content='general' />
    <meta name='generator' content='website' /> -->
    <!-- <meta name='copyright' content='Pemerintah Desa Pasirlangu' /> -->
    <meta name="author" content="@riansutarsa">

    <meta name='keywords' content='<?= deskApp(); ?>' />
    <meta name='subject' content='<?= deskApp(); ?>' />

    <!-- Facebook Open Graph -->
    <meta property="og:title" content="<?= namaApp(); ?> | <?= $title; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url(); ?>" />
    <meta property="og:image" content="<?= base_url('pages/home/images/a.png') ?>" />
    <meta property="og:description" content="<?= deskApp(); ?>">
    <meta property="og:site_name" content="<?= namaApp(); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@kolektorpbb" />
    <meta name="twitter:creator" content="@kolektorpbb" />
    <meta name="twitter:title" content="<?= namaApp(); ?> | <?= $title; ?>" />
    <meta name="twitter:description" content="<?= deskApp(); ?>" />
    <meta name="twitter:image" content="<?= base_url('pages/home/images/a.png') ?>" />

    <title><?= namaApp(); ?> | <?= $title; ?></title>

    <!-- CSSku -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/csspbb.css'); ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Titillium+Web:ital,wght@0,200;0,300;1,200&display=swap" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('fontawesome/fontawesome-free-6.0.0-beta3-web/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">


    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url('assets/jquery/jquery-ui-1.13.0/jquery-ui.css'); ?>">
    <!-- <link rel="stylesheet" type="text/css" href="/jquery-ui/jquery-ui.min.css"> -->

    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="<?= base_url('datatable/css/dataTables.bootstrap4.min.css'); ?>"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/select2/css/select2.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />

    <!-- sweetalert -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.css'); ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/alertify.min.css'); ?>">

    <!-- jQuery -->

    <!-- jQuery UI JS -->
    <!-- <script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script> -->

    <!-- DataTables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- <style>
        @keyframes growProgressBar {
    
                0%,
                33% {
                    --pgPercentage: 0;
                }
    
                100% {
                    --pgPercentage: var(--value);
                }
            }
    
            @property --pgPercentage {
                syntax: '<number>';
                inherits: false;
                initial-value: 0;
            }
    
            div[role="progressbar"] {
                --size: 7rem;
                /* --fg: #369; */
                --fg: #1e51dc;
                --bg: #def;
                --pgPercentage: var(--value);
                animation: growProgressBar 3s 1 forwards;
                width: var(--size);
                height: var(--size);
                border-radius: 50%;
                display: inline-grid;
                padding: 30px 30px;
                place-items: center;
                background:
                    radial-gradient(closest-side, white 60%, transparent 0 99.9%, white 0),
                    conic-gradient(var(--fg) calc(var(--pgPercentage) * 1%), var(--bg) 0);
                font-family: Helvetica, Arial, sans-serif;
                font-size: calc(var(--size) / 9);
                /* font-weight: bold; */
                color: var(--fg);
                float: left;
            }
    
            div[role="progressbar"]::after {
                counter-reset: percentage var(--value);
                content: counter(percentage) '%';
            }
    
            /* demo */
        </style> -->

    <!-- Memasang jQuery Migrate -->
    <script src="<?= base_url('assets/jquery/jquery-3.6.0.min.js'); ?>"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

    <script type='text/javascript'>
        //<![CDATA[
        /*! jQuery Migrate v3.0.1 | (c) jQuery Foundation and other contributors | jquery.org/license */
        void 0 === jQuery.migrateMute && (jQuery.migrateMute = !0),
            function(e) {
                "function" == typeof define && define.amd ? define(["jquery"], window, e) : "object" == typeof module && module.exports ? module.exports = e(require("jquery"), window) : e(jQuery, window)
            }(function(e, t) {
                "use strict";

                function r(r) {
                    var n = t.console;
                    a[r] || (a[r] = !0, e.migrateWarnings.push(r), n && n.warn && !e.migrateMute && (n.warn("JQMIGRATE: " + r), e.migrateTrace && n.trace && n.trace()))
                }

                function n(e, t, n, o) {
                    Object.defineProperty(e, t, {
                        configurable: !0,
                        enumerable: !0,
                        get: function() {
                            return r(o), n
                        },
                        set: function(e) {
                            r(o), n = e
                        }
                    })
                }

                function o(e, t, n, o) {
                    e[t] = function() {
                        return r(o), n.apply(this, arguments)
                    }
                }
                e.migrateVersion = "3.0.1", t.console && t.console.log && (e && !/^[12]\./.test(e.fn.jquery) || t.console.log("JQMIGRATE: jQuery 3.0.0+ REQUIRED"), e.migrateWarnings && t.console.log("JQMIGRATE: Migrate plugin loaded multiple times"), t.console.log("JQMIGRATE: Migrate is installed" + (e.migrateMute ? "" : " with logging active") + ", version " + e.migrateVersion));
                var a = {};
                e.migrateWarnings = [], void 0 === e.migrateTrace && (e.migrateTrace = !0), e.migrateReset = function() {
                    a = {}, e.migrateWarnings.length = 0
                }, "BackCompat" === t.document.compatMode && r("jQuery is not compatible with Quirks Mode");
                var i, s = e.fn.init,
                    u = e.isNumeric,
                    c = e.find,
                    l = /\[(\s*[-\w]+\s*)([~|^$*]?=)\s*([-\w#]*?#[-\w#]*)\s*\]/,
                    d = /\[(\s*[-\w]+\s*)([~|^$*]?=)\s*([-\w#]*?#[-\w#]*)\s*\]/g;
                e.fn.init = function(e) {
                    var t = Array.prototype.slice.call(arguments);
                    return "string" == typeof e && "#" === e && (r("jQuery( '#' ) is not a valid selector"), t[0] = []), s.apply(this, t)
                }, e.fn.init.prototype = e.fn, e.find = function(e) {
                    var n = Array.prototype.slice.call(arguments);
                    if ("string" == typeof e && l.test(e)) try {
                        t.document.querySelector(e)
                    } catch (o) {
                        e = e.replace(d, function(e, t, r, n) {
                            return "[" + t + r + '"' + n + '"]'
                        });
                        try {
                            t.document.querySelector(e), r("Attribute selector with '#' must be quoted: " + n[0]), n[0] = e
                        } catch (e) {
                            r("Attribute selector with '#' was not fixed: " + n[0])
                        }
                    }
                    return c.apply(this, n)
                };
                for (i in c) Object.prototype.hasOwnProperty.call(c, i) && (e.find[i] = c[i]);
                e.fn.size = function() {
                    return r("jQuery.fn.size() is deprecated and removed; use the .length property"), this.length
                }, e.parseJSON = function() {
                    return r("jQuery.parseJSON is deprecated; use JSON.parse"), JSON.parse.apply(null, arguments)
                }, e.isNumeric = function(t) {
                    var n, o, a = u(t),
                        i = (o = (n = t) && n.toString(), !e.isArray(n) && o - parseFloat(o) + 1 >= 0);
                    return a !== i && r("jQuery.isNumeric() should not be called on constructed objects"), i
                }, o(e, "holdReady", e.holdReady, "jQuery.holdReady is deprecated"), o(e, "unique", e.uniqueSort, "jQuery.unique is deprecated; use jQuery.uniqueSort"), n(e.expr, "filters", e.expr.pseudos, "jQuery.expr.filters is deprecated; use jQuery.expr.pseudos"), n(e.expr, ":", e.expr.pseudos, "jQuery.expr[':'] is deprecated; use jQuery.expr.pseudos");
                var p = e.ajax;
                e.ajax = function() {
                    var e = p.apply(this, arguments);
                    return e.promise && (o(e, "success", e.done, "jQXHR.success is deprecated and removed"), o(e, "error", e.fail, "jQXHR.error is deprecated and removed"), o(e, "complete", e.always, "jQXHR.complete is deprecated and removed")), e
                };
                var f = e.fn.removeAttr,
                    y = e.fn.toggleClass,
                    m = /\S+/g;
                e.fn.removeAttr = function(t) {
                    var n = this;
                    return e.each(t.match(m), function(t, o) {
                        e.expr.match.bool.test(o) && (r("jQuery.fn.removeAttr no longer sets boolean properties: " + o), n.prop(o, !1))
                    }), f.apply(this, arguments)
                }, e.fn.toggleClass = function(t) {
                    return void 0 !== t && "boolean" != typeof t ? y.apply(this, arguments) : (r("jQuery.fn.toggleClass( boolean ) is deprecated"), this.each(function() {
                        var r = this.getAttribute && this.getAttribute("class") || "";
                        r && e.data(this, "__className__", r), this.setAttribute && this.setAttribute("class", r || !1 === t ? "" : e.data(this, "__className__") || "")
                    }))
                };
                var h = !1;
                e.swap && e.each(["height", "width", "reliableMarginRight"], function(t, r) {
                    var n = e.cssHooks[r] && e.cssHooks[r].get;
                    n && (e.cssHooks[r].get = function() {
                        var e;
                        return h = !0, e = n.apply(this, arguments), h = !1, e
                    })
                }), e.swap = function(e, t, n, o) {
                    var a, i, s = {};
                    h || r("jQuery.swap() is undocumented and deprecated");
                    for (i in t) s[i] = e.style[i], e.style[i] = t[i];
                    a = n.apply(e, o || []);
                    for (i in t) e.style[i] = s[i];
                    return a
                };
                var g = e.data;
                e.data = function(t, n, o) {
                    var a;
                    if (n && "object" == typeof n && 2 === arguments.length) {
                        a = e.hasData(t) && g.call(this, t);
                        var i = {};
                        for (var s in n) s !== e.camelCase(s) ? (r("jQuery.data() always sets/gets camelCased names: " + s), a[s] = n[s]) : i[s] = n[s];
                        return g.call(this, t, i), n
                    }
                    return n && "string" == typeof n && n !== e.camelCase(n) && (a = e.hasData(t) && g.call(this, t)) && n in a ? (r("jQuery.data() always sets/gets camelCased names: " + n), arguments.length > 2 && (a[n] = o), a[n]) : g.apply(this, arguments)
                };
                var v = e.Tween.prototype.run,
                    j = function(e) {
                        return e
                    };
                e.Tween.prototype.run = function() {
                    e.easing[this.easing].length > 1 && (r("'jQuery.easing." + this.easing.toString() + "' should use only one argument"), e.easing[this.easing] = j), v.apply(this, arguments)
                }, e.fx.interval = e.fx.interval || 13, t.requestAnimationFrame && n(e.fx, "interval", e.fx.interval, "jQuery.fx.interval is deprecated");
                var Q = e.fn.load,
                    b = e.event.add,
                    w = e.event.fix;
                e.event.props = [], e.event.fixHooks = {}, n(e.event.props, "concat", e.event.props.concat, "jQuery.event.props.concat() is deprecated and removed"), e.event.fix = function(t) {
                    var n, o = t.type,
                        a = this.fixHooks[o],
                        i = e.event.props;
                    if (i.length)
                        for (r("jQuery.event.props are deprecated and removed: " + i.join()); i.length;) e.event.addProp(i.pop());
                    if (a && !a._migrated_ && (a._migrated_ = !0, r("jQuery.event.fixHooks are deprecated and removed: " + o), (i = a.props) && i.length))
                        for (; i.length;) e.event.addProp(i.pop());
                    return n = w.call(this, t), a && a.filter ? a.filter(n, t) : n
                }, e.event.add = function(e, n) {
                    return e === t && "load" === n && "complete" === t.document.readyState && r("jQuery(window).on('load'...) called after load event occurred"), b.apply(this, arguments)
                }, e.each(["load", "unload", "error"], function(t, n) {
                    e.fn[n] = function() {
                        var e = Array.prototype.slice.call(arguments, 0);
                        return "load" === n && "string" == typeof e[0] ? Q.apply(this, e) : (r("jQuery.fn." + n + "() is deprecated"), e.splice(0, 0, n), arguments.length ? this.on.apply(this, e) : (this.triggerHandler.apply(this, e), this))
                    }
                }), e.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function(t, n) {
                    e.fn[n] = function(e, t) {
                        return r("jQuery.fn." + n + "() event shorthand is deprecated"), arguments.length > 0 ? this.on(n, null, e, t) : this.trigger(n)
                    }
                }), e(function() {
                    e(t.document).triggerHandler("ready")
                }), e.event.special.ready = {
                    setup: function() {
                        this === t.document && r("'ready' event is deprecated")
                    }
                }, e.fn.extend({
                    bind: function(e, t, n) {
                        return r("jQuery.fn.bind() is deprecated"), this.on(e, null, t, n)
                    },
                    unbind: function(e, t) {
                        return r("jQuery.fn.unbind() is deprecated"), this.off(e, null, t)
                    },
                    delegate: function(e, t, n, o) {
                        return r("jQuery.fn.delegate() is deprecated"), this.on(t, e, n, o)
                    },
                    undelegate: function(e, t, n) {
                        return r("jQuery.fn.undelegate() is deprecated"), 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
                    },
                    hover: function(e, t) {
                        return r("jQuery.fn.hover() is deprecated"), this.on("mouseenter", e).on("mouseleave", t || e)
                    }
                });
                var x = e.fn.offset;
                e.fn.offset = function() {
                    var n, o = this[0],
                        a = {
                            top: 0,
                            left: 0
                        };
                    return o && o.nodeType ? (n = (o.ownerDocument || t.document).documentElement, e.contains(n, o) ? x.apply(this, arguments) : (r("jQuery.fn.offset() requires an element connected to a document"), a)) : (r("jQuery.fn.offset() requires a valid DOM element"), a)
                };
                var k = e.param;
                e.param = function(t, n) {
                    var o = e.ajaxSettings && e.ajaxSettings.traditional;
                    return void 0 === n && o && (r("jQuery.param() no longer uses jQuery.ajaxSettings.traditional"), n = o), k.call(this, t, n)
                };
                var A = e.fn.andSelf || e.fn.addBack;
                e.fn.andSelf = function() {
                    return r("jQuery.fn.andSelf() is deprecated and removed, use jQuery.fn.addBack()"), A.apply(this, arguments)
                };
                var S = e.Deferred,
                    q = [
                        ["resolve", "done", e.Callbacks("once memory"), e.Callbacks("once memory"), "resolved"],
                        ["reject", "fail", e.Callbacks("once memory"), e.Callbacks("once memory"), "rejected"],
                        ["notify", "progress", e.Callbacks("memory"), e.Callbacks("memory")]
                    ];
                return e.Deferred = function(t) {
                    var n = S(),
                        o = n.promise();
                    return n.pipe = o.pipe = function() {
                        var t = arguments;
                        return r("deferred.pipe() is deprecated"), e.Deferred(function(r) {
                            e.each(q, function(a, i) {
                                var s = e.isFunction(t[a]) && t[a];
                                n[i[1]](function() {
                                    var t = s && s.apply(this, arguments);
                                    t && e.isFunction(t.promise) ? t.promise().done(r.resolve).fail(r.reject).progress(r.notify) : r[i[0] + "With"](this === o ? r.promise() : this, s ? [t] : arguments)
                                })
                            }), t = null
                        }).promise()
                    }, t && t.call(n, n), n
                }, e.Deferred.exceptionHook = S.exceptionHook, e
            });
        //]]>
    </script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- <script src="<?= base_url('assets/jquery/jquery-ui-1.13.0/jquery-ui.min.js'); ?>"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    <!-- <script src="<?= base_url(); ?>/assets/plugins/select2/js/select2.min.js"></script> -->
    <script src="<?= base_url(); ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="<?= base_url('assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- MOMENT JS -->
    <script src="<?= base_url('assets/js/moment.js'); ?>"></script>
    <script src="<?= base_url('assets/js/moment-with-locales.js'); ?>" charset="UTF-8"></script>
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>

    <!-- SELECT2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <!-- Modal Header Color -->
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!------ Include the above in your HEAD tag ---------->

</head>