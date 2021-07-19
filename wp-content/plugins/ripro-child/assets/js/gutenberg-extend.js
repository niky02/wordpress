(function ($) {
    $(document).ready(function () {
        console.log("Ridl插件：增强编辑器");
        var b = wp.blocks,
            c = wp.components,
            e = wp.element,
            ed = wp.blockEditor ? wp.blockEditor : wp.editor,
            rE = wp.richText.registerFormatType,

            el = e.createElement,
            rB = b.registerBlockType,

            createBlock = b.createBlock,
            InnerBlocks = ed.InnerBlocks,
            RichTextToolbarButton = ed.RichTextToolbarButton,
            Component = wp.element.Component,
            getRectangleFromRange = wp.dom.getRectangleFromRange,
            Popover = c.Popover,
            RichText = ed.RichText,
            PlainText = ed.PlainText,
            MediaUpload = b.MediaUpload,
            Fragment = e.Fragment,
            InspectorControls = ed.InspectorControls,
            PanelBody = c.PanelBody,
            ClipboardButton = c.ClipboardButton,
            TextControl = c.TextControl,
            RadioControl = c.RadioControl,
            Toolbar = c.Toolbar,
            SelectControl = c.SelectControl,
            ToggleControl = c.ToggleControl,
            CheckboxControl = CheckboxControl,
            RangeControl = c.RangeControl,
            DropdownMenu = c.DropdownMenu,
            BlockControls = ed.BlockControls,
            AlignmentToolbar = ed.AlignmentToolbar;

        var colors = [{
                color: '#fb2121'
            },
            {
                color: '#ef0c7e'
            },
            {
                color: '#F3AC07'
            },
            {
                color: '#8CA803'
            },
            {
                color: '#64BD05'
            },
            {
                color: '#11C33F'
            },
            {
                color: '#08B89A'
            },
            {
                color: '#09ACE2'
            },
            {
                color: '#1F91F3'
            },
            {
                color: '#3B6ED5'
            },
            {
                color: '#664FFA'
            },
            {
                color: '#A845F7'
            },
            {
                color: '#333'
            },
            {
                color: '#666'
            },
            {
                color: '#999'
            },
            {
                color: '#f8f8f8'
            },
        ];
        //---------------------------------------------
        rB('zibllblock/feature', {
            title: 'Ridl插件：亮点',
            icon: {
                src: 'awards',
                foreground: '#f85253'
            },
            description: '包含图标和简介的亮点介绍，建议4个一组',
            category: 'zibll_block_cat',
            attributes: {
                title: {
                    type: "array",
                    source: 'children',
                    selector: ".feature-title",
                },
                icon: {
                    source: 'attribute',
                    selector: '.feature',
                    attribute: 'data-icon'
                },
                note: {
                    type: "array",
                    source: 'children',
                    selector: ".feature-note",
                },
                theme: {
                    source: 'attribute',
                    selector: '.feature',
                    attribute: 'class'
                },
                color: {
                    source: 'attribute',
                    selector: '.feature',
                    attribute: 'data-color'
                },
            },
            edit: function (props) {
                var at = props.attributes,
                    isS = props.isSelected,
                    sa = props.setAttributes,
                    bt = at.title,
                    jj = at.note,
                    ic = at.icon || 'fa-flag',
                    icc = at.color || 'feature-icon no1',
                    zt = at.theme || 'panel panel-default';

                function changecolor(e) {
                    var type = e.target.className;
                    sa({
                        color: type
                    });
                }

                function changetheme(e) {
                    var type = e.target.className;
                    sa({
                        theme: type
                    });
                }

                let Coc = el(c.ColorPalette, {
                    value: icc || '#444',
                    colors: colors,
                    className: "q-ColorPalette",
                    onChange: function (e) {
                        sa({
                            color: e
                        })
                    }
                });

                rti = el(
                        TextControl, {
                            tagName: 'div',
                            onChange: function (e) {
                                sa({
                                    icon: e
                                })
                            },
                            value: ic,
                            placeholder: '请输入图标class代码...'
                        }),

                    rt = el(
                        RichText, {
                            tagName: 'div',
                            onChange: function (e) {
                                sa({
                                    title: e
                                })
                            },
                            value: bt,
                            placeholder: '请输入亮点标题...'
                        }),
                    rtj = el(
                        RichText, {
                            tagName: 'div',
                            onChange: function (e) {
                                sa({
                                    note: e
                                })
                            },
                            value: jj,
                            placeholder: '请输入亮点简介...'
                        }),

                    ztan = el('div', {
                        className: 'g_extend anz panel_b'
                    }, [
                        el('button', {
                            className: 'feature-icon no1',
                            onClick: changecolor
                        }),
                        el('button', {
                            className: 'feature-icon no2',
                            onClick: changecolor
                        }),
                        el('button', {
                            className: 'feature-icon no3',
                            onClick: changecolor
                        }),
                        el('button', {
                            className: 'feature-icon no4',
                            onClick: changecolor
                        }),
                        el('button', {
                            className: 'feature-icon no5',
                            onClick: changecolor
                        }),
                    ]);

                return el('div', {}, el('div', {
                            className: "feature"
                        },
                        el('div', {
                            className: "feature-icon"
                        }, el('i', {
                            style: {
                                color: icc
                            },
                            className: "fa " + ic
                        })),

                        [isS && el('div', {
                            className: "feature-iconbj"
                        }, el('div', {
                            className: "feature-icont"
                        }, '请输入FA图标class代码：'), rti)], [isS && Coc],
                        el('div', {
                            className: "feature-title"
                        }, rt),
                        el('div', {
                            className: "feature-note"
                        }, rtj)
                    ),

                    el(InspectorControls, null,
                        el('div', {
                                className: 'modal-ss'
                            },
                            el('h5', {}, '图标使用说明'),
                            el('p', {}, '图标使用Font Awesome图标库v4.7版本，你可以搜索Font Awesome或者在以下网站找到全部图标代码'),
                            el('a', {
                                href: 'http://fontawesome.dashgame.com',
                                target: 'blank'
                            }, 'Font Awesome图标库'),
                        ),
                        el(PanelBody, {
                                icon: "admin-generic",
                                title: "设置"
                            },
                            el('div', {
                                className: "feature-icont"
                            }, 'FA图标class代码：'), rti,
                            el('div', {
                                className: "feature-icont"
                            }, '选择图标颜色：'), Coc,
                        )
                    )

                )
            },
            save: function (props) {
                var at = props.attributes,
                    bt = at.title,
                    jj = at.note,
                    icc = at.color || 'feature-icon no1',
                    ic = at.icon || 'fa-flag',
                    zt = at.theme || 'feature feature-default';

                return el('div', {
                        className: zt,
                        'data-icon': ic,
                        'data-color': icc
                    },
                    el('div', {
                        className: "feature-icon"
                    }, el('i', {
                        style: {
                            color: icc
                        },
                        className: "fa " + ic
                    })),
                    el('div', {
                        className: 'feature-title'
                    }, bt),
                    el('div', {
                        className: 'feature-note'
                    }, jj),
                );
            },
        });

        //---------------------------------------------
        rE('zibllblock/set-color', {
            title: '设定颜色',
            tagName: 'qc',
            className: null,
            attributes: {
                style: 'style',
                block: 'inline-block'
            },
            edit: class extend_Edit extends Component {
                constructor() {
                    super(...arguments);
                    this.show_modal = this.show_modal.bind(this);
                    this.close_modal = this.close_modal.bind(this);
                    this.words_selected = this.words_selected.bind(this);
                    this.set_popover_rect = this.set_popover_rect.bind(this);
                    this.remove_Format = this.remove_Format.bind(this);
                    this.onChange_cb = this.onChange_cb.bind(this);
                    this.set_color = this.set_color.bind(this);
                    this.set_color2 = this.set_color2.bind(this);
                    this.xsba = this.xsba.bind(this);
                    this.xsba_f = this.xsba_f.bind(this);
                    this.set_background = this.set_background.bind(this);
                    this.set_background2 = this.set_background2.bind(this);
                    this.state = {
                        modal_visibility: false
                    };
                }
                words_selected() {
                    const {
                        value
                    } = this.props;
                    return value.start !== value.end;
                }
                set_popover_rect() {
                    const selection = window.getSelection();
                    const range = selection.rangeCount > 0 ? selection.getRangeAt(0) : null;
                    var rectangle = getRectangleFromRange(range);
                    this.setState({
                        popover_rect: rectangle
                    });
                }
                show_modal() {
                    this.setState({
                        modal_visibility: true
                    });
                    this.set_popover_rect();
                }
                close_modal() {
                    this.setState({
                        modal_visibility: false
                    });
                }
                xsba() {
                    this.setState({
                        xsba: true
                    });
                }
                xsba_f() {
                    this.setState({
                        xsba: false
                    });
                }
                remove_Format(e) {
                    this.setState({
                        color: '',
                        background: ''
                    });
                    this.props.onChange(wp.richText.toggleFormat(
                        this.props.value, {
                            type: 'zibllblock/set-color',
                        }))
                }
                onChange_cb() {
                    this.props.onChange(wp.richText.applyFormat(
                        this.props.value, {
                            type: 'zibllblock/set-color',
                            attributes: {
                                style: "color:" + this.state.color + ";background:" + this.state.background,
                            }
                        }))
                }
                set_color(e) {
                    this.setState({
                        color: 'rgb(' + e.rgb.r + ',' + e.rgb.g + ',' + e.rgb.b + ',' + e.rgb.a + ')'
                    });
                    this.onChange_cb();
                }
                set_color2(e) {
                    this.setState({
                        color: e
                    });
                    this.props.onChange(wp.richText.applyFormat(
                        this.props.value, {
                            type: 'zibllblock/set-color',
                            attributes: {
                                style: "color:" + e + ";background:" + this.state.background,
                            }
                        }))
                }

                set_background2(e) {
                    this.setState({
                        background: e
                    });
                    this.props.onChange(wp.richText.applyFormat(
                        this.props.value, {
                            type: 'zibllblock/set-color',
                            attributes: {
                                style: "color:" + this.state.color + ";background:" + e,
                            }
                        }))
                }
                set_background(e) {
                    this.setState({
                        background: 'rgb(' + e.rgb.r + ',' + e.rgb.g + ',' + e.rgb.b + ',' + e.rgb.a + ')'
                    });
                    this.onChange_cb();
                }
                render() {
                    let {
                        isActive
                    } = this.props;
                    var props = this.props;
                    let Co = el(c.ColorPicker, {
                        color: this.state.color || '#444',
                        onChangeComplete: this.set_color
                    });
                    let Coc = el(c.ColorPalette, {
                        value: this.state.color || '#444',
                        colors: colors,
                        clearable: false,
                        className: "q-ColorPalette",
                        disableCustomColors: true,
                        onChange: this.set_color2
                    });
                    let Bob = el(c.ColorPalette, {
                        value: this.state.background || '#fff',
                        colors: colors,
                        clearable: false,
                        className: "q-ColorPalette",
                        disableCustomColors: true,
                        onChange: this.set_background2
                    });
                    let Cob = el(c.ColorPicker, {
                            color: this.state.background || '#fff',
                            onChangeComplete: this.set_background
                        }),
                        cz = el('button', {
                            className: 'remove-Format',
                            onClick: this.remove_Format
                        }, el('span', {
                            className: 'dashicons dashicons-image-rotate',
                        }));
                    return el(Fragment, null, el(RichTextToolbarButton, {
                        icon: "art",
                        title: "自定义颜色",
                        onClick: this.show_modal,
                        isActive: isActive,
                        isDisabled: !this.words_selected()
                    }), this.state.modal_visibility && el(Popover, {
                            anchorRect: this.state.popover_rect,
                            position: "bottom center",
                            className: "color_popover",
                            onFocusOutside: this.close_modal
                        },
                        el(c.ButtonGroup, {},
                            el('button', {
                                className: "btn btn-default " + (!this.state.xsba && "isS"),
                                onClick: this.xsba_f,
                            }, "颜色"),
                            el('button', {
                                className: "btn btn-default " + (this.state.xsba && "isS"),
                                onClick: this.xsba,
                            }, "背景色")),

                        cz,
                        !this.state.xsba && el("div", {

                        }, el("p", {}, "请选择文字颜色"), Coc, Co),
                        this.state.xsba && el("div", {

                        }, el("p", {}, "请选择背景颜色"), Bob, Cob)

                    ));
                }
            }
        });

        //---------------------------------------------
      
        //---------------------------------------------
        rB('zibllblock/collapse', {
            title: 'Ridl插件：折叠框',
            icon: {
                src: 'sort',
                foreground: '#f85253'
            },
            description: '手风琴折叠框，可以插入任意内容，点击标题可切换内容显示和隐藏',
            category: 'zibll_block_cat',
            attributes: {
                biaoti: {
                    type: "array",
                    source: 'children',
                    selector: ".biaoti",
                },
                isshow: {
                    type: "attribute",
                    selector: '.panel',
                    attribute: "data-isshow",
                    default: true
                },
                theme: {
                    source: 'attribute',
                    selector: '.panel',
                    attribute: 'class'
                },
                id: {
                    source: 'attribute',
                    selector: '.collapse',
                    attribute: 'id'
                },
                ffs: {
                    source: 'string',
                }
            },
            edit: function (props) {
                var at = props.attributes,
                    bt = at.biaoti,
                    zt = at.theme || 'panel panel-default',
                    kg = at.isshow,
                    isS = props.isSelected,
                    ffs = at.ffs || 'ffshow',
                    sa = props.setAttributes;

                var sjs = parseInt((Math.random() + 1) * Math.pow(10, 4));

                if (!at.id) {
                    sa({
                        id: "collapse_" + sjs
                    })
                }

                function ffshow(e) {
                    if (ffs == 'ffshow') {
                        sa({
                            ffs: 'ffhide'
                        });
                    } else {
                        sa({
                            ffs: 'ffshow'
                        });
                    }
                }

                function changeType(e) {
                    var type = e.target.className;
                    sa({
                        theme: 'panel ' + type
                    });
                }
                var xzk = el(InnerBlocks, {}, ''),
                    rt = el(
                        RichText, {
                            tagName: 'div',
                            onChange: function (e) {
                                sa({
                                    biaoti: e
                                })
                            },
                            value: bt,
                            isSelected: props.isSelected,
                            placeholder: '请输入折叠框标题...'
                        }),
                    ztan = el('span', {
                        className: 'g_extend anz panel_b'
                    }, [
                        el('button', {
                            className: 'panel-default',
                            onClick: changeType
                        }),
                        el('button', {
                            className: 'panel-info',
                            onClick: changeType
                        }),
                        el('button', {
                            className: 'panel-success',
                            onClick: changeType
                        }),
                        el('button', {
                            className: 'panel-warning',
                            onClick: changeType
                        }), el('button', {
                            className: 'panel-danger',
                            onClick: changeType
                        }),
                    ]),
                    shkg = el(ToggleControl, {
                        label: '默认状态',
                        checked: kg,
                        onChange: function (e) {
                            sa({
                                isshow: e
                            })
                        }
                    });
                return el('div', {}, el('div', {
                        className: zt,
                    }, el('div', {
                        className: "panel-heading"
                    }, rt), el('span', {
                        className: ffs + " isshow dashicons dashicons-arrow-down-alt2",
                        onClick: ffshow
                    }), el('div', {
                        className: ffs + " panel-body"
                    }, xzk)),

                    el(InspectorControls, null,
                        el(PanelBody, {
                            icon: "admin-generic",
                            title: "设置"
                        }), el('div', {}, '主题样式'), el('p', {}, shkg),
                        el('i', {
                            className: '.components-base-control__help'
                        }, kg ? '默认为展开状态' : '默认为折叠状态'))
                );
            },
            save: function (props) {
                var con = InnerBlocks.Content,
                    at = props.attributes,
                    zt = at.theme || 'panel',
                    kg = at.isshow,
                    id = at.id,
                    bt = at.biaoti;

                bth = el('div', {
                    className: "panel-heading " + (kg ? '' : 'collapsed'),
                    href: "#" + id,
                    "data-toggle": "collapse",
                    "aria-controls": "collapseExample",
                }, el('i', {
                    className: "fa fa-plus"
                }), el('strong', {
                    className: "biaoti ",
                }, bt))
                coh = el('div', {
                    className: "collapse " + (kg ? 'in' : ''),
                    id: id,
                }, el('div', {
                    className: "panel-body"
                }, el(InnerBlocks.Content)));

                return el('div', {}, el('div', {
                    className: zt,
                    "data-theme": zt,
                    "data-isshow": kg,
                }, bth, coh));
            },
        });
        //-------------------------------------------------------------
       
        //-------------------------------------------
        rB('zibllblock/biaoti', {
            title: 'Ridl插件：标题',
            icon: {
                src: 'minus',
                foreground: '#f85253'
            },
            category: 'zibll_block_cat',
            description: "和主题样式匹配的文章标题，可自定义颜色",
            className: false,
            attributes: {
                content: {
                    type: 'array',
                    source: 'children',
                    selector: 'h1',
                },
                typeClass: {
                    source: 'attribute',
                    selector: '.title-theme',
                    attribute: 'class',
                },
                color: {
                    source: 'attribute',
                    selector: 'h1',
                    attribute: 'data-color',
                }
            },
            transforms: {
                from: [{
                    type: "block",
                    blocks: ["core/heading", "core/preformatted", "core/paragraph"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("zibllblock/biaoti", {
                            content: t
                        })
                    }
                }, ],
                to: [{
                    type: "block",
                    blocks: ["core/heading"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/heading", {
                            content: t
                        })
                    }
                }, {
                    type: "block",
                    blocks: ["core/paragraph"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/paragraph", {
                            content: t
                        })
                    }
                }, {
                    type: "block",
                    blocks: ["core/preformatted"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/preformatted", {
                            content: t
                        })
                    }
                }]
            },
            edit: function (props) {
                var content = props.attributes.content,
                    typeClass = content.typeClass || 'title-theme',
                    isSelected = props.isSelected;
                color = props.attributes.color;
                sty = color && '--theme-color:' + color;

                function onChangeContent(newContent) {
                    props.setAttributes({
                        content: newContent
                    });
                }

                function changeType(event) {
                    var type = event.target.className;
                    props.setAttributes({
                        typeClass: 'title-theme ' + type
                    });
                }

                function changecolor(c) {
                    props.setAttributes({
                        color: c
                    });
                }

                var richText = el(
                    RichText, {
                        tagName: 'div',
                        onChange: onChangeContent,
                        value: content,
                        isSelected: props.isSelected,
                        placeholder: '请输入标题...'
                    });

                var outerHtml = el('div', {
                    className: typeClass,
                    'data-color': color,
                    style: {
                        color: color,
                        'border-left-color': color
                    }
                }, el('h1', {}, richText));
                var selector = el('div', {
                    className: 'g_extend anz'
                }, [
                    el('button', {
                        className: 'qe_bt_zts',
                        onClick: changeType
                    }, '主题色'),
                    el('button', {
                        className: 'qe_bt_lan',
                        onClick: changeType
                    }, '蓝色'),
                    el('button', {
                        className: 'qe_bt_hui',
                        onClick: changeType
                    }, '灰色'),
                    el('button', {
                        className: 'qe_bt_c-red',
                        onClick: changeType
                    }, '红色'),
                ]);
                var Co = el(c.ColorPalette, {
                    value: color,
                    colors: colors,
                    className: "q-ColorPalette",
                    onChange: changecolor
                });

                return el('div', {}, outerHtml,
                    el(InspectorControls, null,
                        el(PanelBody, {
                            title: "自定义颜色"
                        }),
                        el('p', {}, '默认颜色为主题高亮颜色，如需要自定义颜色，请在下方选择颜色'), el('p', {}, Co)));

            },

            save: function (props) {
                var content = props.attributes.content,
                    typeClass = props.attributes.typeClass || 'title-theme',
                    color = props.attributes.color;
                sty = color && '--theme-color:' + color;

                var outerHtml = el('h2', {
                    'data-color': color,
                    className: typeClass,
                    style: sty
                }, content);

                return outerHtml;
            }
        });
        //---------------------------------------------
    
        rB('zibllblock/quote', {
            title: 'Ridl插件：引言',
            icon: {
                src: 'format-quote',
                foreground: '#f85253'
            },
            description: '几种不同的引言框',
            category: 'zibll_block_cat',
            attributes: {
                content: {
                    type: 'array',
                    source: 'children',
                    selector: '.quote_q p',
                },
                typeClass: {
                    source: 'attribute',
                    selector: '.quote_q',
                    attribute: 'class',
                },
                color: {
                    source: 'attribute',
                    selector: '.quote_q',
                    attribute: 'data-color',
                }
            },
            transforms: {
                from: [{
                    type: "block",
                    blocks: ["zibllblock/alert", "core/quote", "core/preformatted", "core/paragraph"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("zibllblock/quote", {
                            content: t
                        })
                    }
                }, ],
                to: [{
                    type: "block",
                    blocks: ["core/quote"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/quote", {
                            content: t
                        })
                    }
                }, {
                    type: "block",
                    blocks: ["zibllblock/alert"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("zibllblock/alert", {
                            content: t
                        })
                    }
                }, {
                    type: "block",
                    blocks: ["core/paragraph"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/paragraph", {
                            content: t
                        })
                    }
                }, {
                    type: "block",
                    blocks: ["core/preformatted"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/preformatted", {
                            content: t
                        })
                    }
                }]
            },
            edit: function (props) {
                var content = props.attributes.content,
                    typeClass = props.attributes.typeClass || 'quote_q',
                    isSelected = props.isSelected;
                color = props.attributes.color;
                sty = color ? color : '';

                function changecolor(e) {
                    props.setAttributes({
                        color: e
                    });
                }

                function onChangeContent(e) {
                    props.setAttributes({
                        content: e
                    });
                }

                function changeType(e) {
                    var type = e.target.className;
                    props.setAttributes({
                        typeClass: 'quote_q ' + type
                    });
                }

                var richText = el(
                    RichText, {
                        tagName: 'div',
                        isSelected: props.isSelected,
                        onChange: onChangeContent,
                        value: content,
                        placeholder: '请输入内容...'
                    });
                var outerHtml = el('div', {
                    className: typeClass,
                    style: {
                        '--quote-color': sty
                    }
                },el('i', {className: "fa fa-quote-left"}), richText);


                var Co = el(c.ColorPalette, {
                    value: color || '#555',
                    colors: colors,
                    className: "q-ColorPalette",
                    onChange: changecolor
                });

                return el('div', {}, outerHtml,el('div', {},
                    el(InspectorControls, null,
                        el(PanelBody, {
                            title: "自定义颜色"
                        }),
                        el('p', {}, '默认为主题颜色，如果需自定义请在下方选择颜色（引言默认透明度为70%，请不要选择较浅的颜色，并请注意深色主题的显示效果）'),
                         el('p', {}, Co))));
            },
            save: function (props) {
                var content = props.attributes.content,
                    typeClass = props.attributes.typeClass || 'quote_q';
                color = props.attributes.color;
                sty = color && '--quote-color:' + color;

                var outerHtml = el('div', {
                    className: typeClass,
                    'data-color': color,
                    style: sty
                }, el('i', {
                    className: 'fa fa-quote-left'
                }), el('p', {}, content));

                return el('div', {}, outerHtml);

            },
        });
        //-------------------------------------------------------------
        rB('zibllblock/alert', {
            title: 'Ridl插件：提醒框',
            icon: {
                src: 'info',
                foreground: '#f85253'
            },
            description: '几种不同的提醒框，可选择关闭按钮',
            category: 'zibll_block_cat',
            attributes: {
                content: {
                    type: 'array',
                    source: 'children',
                    selector: 'div.alert',
                },
                typeClass: {
                    source: 'attribute',
                    selector: '.alert',
                    attribute: 'class',
                },
                isChecked: {
                    type: "attribute",
                    attribute: "data-isclose"
                }
            },
            transforms: {
                from: [{
                    type: "block",
                    blocks: ["zibllblock/quote", "core/quote", "core/preformatted", "core/paragraph"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("zibllblock/alert", {
                            content: t
                        })
                    }
                }, ],
                to: [{
                    type: "block",
                    blocks: ["core/quote"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/quote", {
                            content: t
                        })
                    }
                }, {
                    type: "block",
                    blocks: ["zibllblock/quote"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("zibllblock/quote", {
                            content: t
                        })
                    }
                }, {
                    type: "block",
                    blocks: ["core/paragraph"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/paragraph", {
                            content: t
                        })
                    }
                }, {
                    type: "block",
                    blocks: ["core/preformatted"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("core/preformatted", {
                            content: t
                        })
                    }
                }]
            },
            edit: function (props) {
                var content = props.attributes.content,
                    typeClass = props.attributes.typeClass || 'alert jb-blue',
                    isChecked = props.attributes.isChecked,
                    isSelected = props.isSelected;

                function onChangeContent(e) {
                    props.setAttributes({
                        content: e
                    });
                }

                function onisChecked(e) {
                    props.setAttributes({
                        isChecked: e
                    });
                }

                function changeType(e) {
                    var type = e.target.className;
                    props.setAttributes({
                        typeClass: 'alert ' + type
                    });
                }
                var richText = el(
                    RichText, {
                        tagName: 'div',
                        isSelected: props.isSelected,
                        onChange: onChangeContent,
                        value: content,
                        placeholder: '请输入内容...'
                    });

                var outerHtml = el('div', {
                    className: typeClass
                }, richText);

                var selector = el('span', {
                        className: 'g_extend anz alert_b'
                    }, [
                        el('button', {
                            className: 'jb-blue',
                            onClick: changeType
                        }),
                        el('button', {
                            className: 'jb-green',
                            onClick: changeType
                        }),
                        el('button', {
                            className: 'jb-yellow',
                            onClick: changeType
                        }),
                        el('button', {
                            className: 'jb-red',
                            onClick: changeType
                        }),
                    ]),
                    closebutton = el('div', {
                        className: 'close_an',
                    }, el(ToggleControl, {
                        label: '提醒框可关闭',
                        checked: isChecked,
                        onChange: onisChecked
                    }));

                return el('div', {}, [outerHtml, isChecked && el('button', {
                        className: 'close'
                    }, '×'), isSelected && selector, isSelected && closebutton],
                    el(InspectorControls, null,
                        el(PanelBody, {
                            icon: "admin-appearance",
                            title: "提醒框设置"
                        }), el('div', {}, '提醒框类型'), el('p', {}, selector), el('div', {}, '关闭按钮'), closebutton))

            },
            save: function (props) {
                var content = props.attributes.content,
                    isChecked = props.attributes.isChecked,
                    typeClass = props.attributes.typeClass || 'alert jb-blue';

                var outerHtml = el('div', {
                    className: typeClass,
                    "data-isclose": isChecked,
                    "role": 'alert'
                }, [isChecked && el('button', {
                    'type': 'button',
                    className: 'close',
                    'data-dismiss': 'alert',
                    'aria-label': 'Close'
                }, el('div', {
                    'data-class': "ic-close",
                    'data-svg': "close",
                    'data-viewbox': "0 0 1024 1024"
                }))], content);
                return el('div', {
                    className: 'alert-dismissible fade in'
                }, outerHtml);
            },
        });
        //-------------------------------------------------------------
        rB('zibllblock/buttons', {
            title: 'Ridl插件：按钮组',
            description: '多种样式的按钮',
            icon: {
                src: 'marker',
                foreground: '#f85253'
            },
            category: 'zibll_block_cat',
            attributes: {
                alignment: {
                    type: 'string',
                },
                quantity: {
                    type: "attribute",
                    attribute: "data-quantity",
                    default: 1
                },
                radius: {
                    type: "attribute",
                    attribute: "data-radius",
                    default: true
                },
                content1: {
                    type: 'array',
                    source: 'children',
                    selector: 'span.an_1',
                },
                typeClass1: {
                    source: 'attribute',
                    selector: '.an_1',
                    attribute: 'class',
                },
                content2: {
                    type: 'array',
                    source: 'children',
                    selector: 'span.an_2',
                },
                typeClass2: {
                    source: 'attribute',
                    selector: '.an_2',
                    attribute: 'class',
                },
                content3: {
                    type: 'array',
                    source: 'children',
                    selector: 'span.an_3',
                },
                typeClass3: {
                    source: 'attribute',
                    selector: '.an_3',
                    attribute: 'class',
                },
                content4: {
                    type: 'array',
                    source: 'children',
                    selector: 'span.an_4',
                },
                typeClass4: {
                    source: 'attribute',
                    selector: '.an_4',
                    attribute: 'class',
                },
                content5: {
                    type: 'array',
                    source: 'children',
                    selector: 'span.an_5',
                },
                typeClass5: {
                    source: 'attribute',
                    selector: '.an_5',
                    attribute: 'class',
                }
            },
            transforms: {
                from: [{
                    type: "block",
                    blocks: ["core/paragraph"],
                    transform: function (e) {
                        var t = e.content;
                        return createBlock("zibllblock/buttons", {
                            content1: t
                        })
                    }
                }, ],
                to: [{
                    type: "block",
                    blocks: ["core/paragraph"],
                    transform: function (e) {
                        var t = e.content1;
                        return createBlock("core/paragraph", {
                            content: t
                        })
                    }
                }]
            },
            edit: function (props) {
                var at = props.attributes,
                    sa = props.setAttributes,
                    alignment = at.alignment,
                    isS = props.isSelected,
                    sl = at.quantity,
                    rd = at.radius,
                    c = [];

                for (let i = 0; i <= 5; i++) {
                    c['c' + i] = at['content' + i],
                        c['cs' + i] = at['typeClass' + i] || 'but b-blue',
                        c['rt' + i] = el(
                            RichText, {
                                tagName: 'div',
                                onChange: function (e) {
                                    sa({
                                        ['content' + i]: e
                                    })
                                },
                                value: c['c' + i],
                                isSelected: props.isS,
                                placeholder: '按钮-' + i
                            }),
                        c['crt' + i] = el('div', {
                            className: c['cs' + i],
                        }, c['rt' + i]),
                        c['bk' + i] = el('button', {
                            className: 'anz sz',
                            onClick: function (e) {
                                $('.anz.an.x' + i).slideToggle(200)
                            }
                        }, el('span', {
                            className: 'dashicons dashicons-admin-appearance'
                        })),
                        c['btt' + i] = el('div', {
                                className: 'g_extend anz an x' + i
                            },
                            el('button', {
                                className: 'but b-red',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but b-yellow',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but b-blue',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but b-green',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but b-purple',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but hollow c-red',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but hollow c-yellow',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but hollow c-blue',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but hollow c-green',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but hollow c-purple',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but jb-red',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but jb-yellow',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]: 'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but jb-blue',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]: 'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but jb-green',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]: 'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                            el('button', {
                                className: 'but jb-purple',
                                onClick: function (e) {
                                    sa({
                                        ['typeClass' + i]:'an_' + i + ' ' + e.target.className
                                    })
                                }
                            }, ''),
                        );
                }

                var gjl = el(Toolbar, {}, el(DropdownMenu, {
                        icon: "plus-alt",
                        className: 'zibllblock-buttons-sl',
                        label: "按钮数量",
                        controls: [{
                                title: '1个',
                                value: 1,
                                onClick: function (e) {
                                    sa({
                                        quantity: 1
                                    })
                                }
                            }, {
                                title: '2个',
                                onClick: function (e) {
                                    sa({
                                        quantity: 2
                                    })
                                }
                            }, {
                                title: '3个',
                                value: 3,
                                onClick: function (e) {
                                    sa({
                                        quantity: 3
                                    })
                                }
                            }, {
                                title: '4个',
                                value: 4,
                                onClick: function (e) {
                                    sa({
                                        quantity: 4
                                    })
                                }
                            }, {
                                title: '5个',
                                value: 5,
                                onClick: function (e) {
                                    sa({
                                        quantity: 5
                                    })
                                }
                            }

                        ]
                    })),
                    dqk = el(Fragment, null, el(BlockControls, null, gjl, el(AlignmentToolbar, {
                        value: alignment,
                        onChange: function (e) {
                            sa({
                                alignment: e
                            })
                        }
                    })));

                return el('div', {
                        style: {
                            textAlign: alignment
                        },
                        className: 'aniuzu ' + (rd  && 'radius')
                    }, dqk,
                    [c.crt1, isS && c.bk1, isS && c.btt1],
                    [sl >= 2 && [c.crt2, isS && c.bk2, isS && c.btt2]],
                    [sl >= 3 && [c.crt3, isS && c.bk3, isS && c.btt3]],
                    [sl >= 4 && [c.crt4, isS && c.bk4, isS && c.btt4]],
                    [sl >= 5 && [c.crt5, isS && c.bk5, isS && c.btt5]],
                    el(InspectorControls, null,
                        el(PanelBody, {
                            icon: "admin-generic",
                            title: "按钮设置"
                        }, el(RangeControl, {
                            label: "按钮数量",
                            value: sl,
                            onChange: function (e) {
                                sa({
                                    quantity: e
                                })
                            },
                            min: "1",
                            max: "5"
                        }), el(ToggleControl, {
                            className: 'close_an',
                            label: '按钮圆角',
                            checked: rd,
                            onChange: function (e) {
                                sa({
                                    radius: e
                                })
                            }
                        }))
                    ));
            },
            save: function (props) {
                var at = props.attributes,
                    sa = props.setAttributes,
                    alignment = at.alignment,
                    isSelected = props.isSelected,
                    sl = at.quantity,
                    rd = at.radius,
                    c = [];

                for (let i = 0; i <= 5; i++) {
                    c[i] = at['content' + i],
                        c['s' + i] = at['typeClass' + i] || 'an_' + i + ' but b-blue',
                        c['jg' + i] = el('span', {
                            className: c['s' + i]
                        }, c[i]);
                }
                return outerHtml = el('div', {
                        "data-quantity": sl,
                        "data-radius": rd,
                        style: {
                            textAlign: alignment
                        },
                        className: rd && 'radius'
                    },
                    [sl > 0 && c.jg1], [sl > 1 && c.jg2], [sl > 2 && c.jg3], [sl > 3 && c.jg4], [sl > 4 && c.jg5]
                );
            },
        });
    
        //-------------------------------------------------------------
        //-------------------------------------------------------------

    })
})(jQuery);