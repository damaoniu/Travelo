/*Block Quotes*/
(function() {
    tinymce.create('tinymce.plugins.blockquote_btn', {
        init : function(ed, url) {
            ed.addButton('blockquote_btn', {
                title : 'Blockquote',
                image : url+'/shortcodesImg/dropcap.png',
                onclick : function() {
                    ed.selection.setContent('[blockquote]' + ed.selection.getContent() + '[/blockquote]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('blockquote_btn', tinymce.plugins.blockquote_btn);
})();
/*Block Quotes*/
/*h1*/
(function() {
    tinymce.create('tinymce.plugins.h1_btn', {
        init : function(ed, url) {
            ed.addButton('h1_btn', {
                title : 'h1',
                image : url+'/shortcodesImg/h1.png',
                onclick : function() {
                    ed.selection.setContent('[h1]' + ed.selection.getContent() + '[/h1]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('h1_btn', tinymce.plugins.h1_btn);
})();
/*h1*/
/*h2*/
(function() {
    tinymce.create('tinymce.plugins.h2_btn', {
        init : function(ed, url) {
            ed.addButton('h2_btn', {
                title : 'h2',
                image : url+'/shortcodesImg/h2.png',
                onclick : function() {
                    ed.selection.setContent('[h2]' + ed.selection.getContent() + '[/h2]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('h2_btn', tinymce.plugins.h2_btn);
})();
/*h2*/
/*h3*/
(function() {
    tinymce.create('tinymce.plugins.h3_btn', {
        init : function(ed, url) {
            ed.addButton('h3_btn', {
                title : 'h3',
                image : url+'/shortcodesImg/h3.png',
                onclick : function() {
                    ed.selection.setContent('[h3]' + ed.selection.getContent() + '[/h3]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('h3_btn', tinymce.plugins.h3_btn);
})();
/*h3*/
/*h4*/
(function() {
    tinymce.create('tinymce.plugins.h4_btn', {
        init : function(ed, url) {
            ed.addButton('h4_btn', {
                title : 'h4',
                image : url+'/shortcodesImg/h4.png',
                onclick : function() {
                    ed.selection.setContent('[h4]' + ed.selection.getContent() + '[/h4]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('h4_btn', tinymce.plugins.h4_btn);
})();
/*h4*/
/*h5*/
(function() {
    tinymce.create('tinymce.plugins.h5_btn', {
        init : function(ed, url) {
            ed.addButton('h5_btn', {
                title : 'h5',
                image : url+'/shortcodesImg/h5.png',
                onclick : function() {
                    ed.selection.setContent('[h5]' + ed.selection.getContent() + '[/h5]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('h5_btn', tinymce.plugins.h5_btn);
})();
/*h5*/
/*h6*/
(function() {
    tinymce.create('tinymce.plugins.h6_btn', {
        init : function(ed, url) {
            ed.addButton('h6_btn', {
                title : 'h5',
                image : url+'/shortcodesImg/h6.png',
                onclick : function() {
                    ed.selection.setContent('[h6]' + ed.selection.getContent() + '[/h6]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('h6_btn', tinymce.plugins.h6_btn);
})();
/*h6*/
/*Accordion*/
(function() {
    tinymce.create('tinymce.plugins.accordion', {
        init : function(ed, url) {
            ed.addButton('accordion', {
                title : 'Accordion',
                image : url+'/shortcodesImg/toggle.png',
                onclick : function() {
                     ed.selection.setContent("[accordion]\r\n[accordion_item title=\"\"]" + ed.selection.getContent() + "[/accordion_item]\r\n[/accordion]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
})();
/*Accordion*/
/*Tabs*/
(function() {
    tinymce.create('tinymce.plugins.tabs', {
        init : function(ed, url) {
            ed.addButton('tabs', {
                title : 'Tabs',
                image : url+'/shortcodesImg/tab.png',
                onclick : function() {
                     ed.selection.setContent("[tabgroup][tab title=\"\"]" + ed.selection.getContent() + "[/tab][/tabgroup]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
})();
/*Tabs*/
/*buttonWhite*/
(function() {
    tinymce.create('tinymce.plugins.buttonWhite', {
        init : function(ed, url) {
            ed.addButton('buttonWhite', {
                title : 'White Button',
                image : url+'/shortcodesImg/buttonWhite.png',
                onclick : function() {
                     ed.selection.setContent("[buttonWhite][button link=\"\"]" + ed.selection.getContent() + "[/button][/buttonWhite]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('buttonWhite', tinymce.plugins.buttonWhite);
})();
/*buttonWhite*/
/*buttonWhite*/
(function() {
    tinymce.create('tinymce.plugins.buttonBlack', {
        init : function(ed, url) {
            ed.addButton('buttonBlack', {
                title : 'Black Button',
                image : url+'/shortcodesImg/buttonBlack.png',
                onclick : function() {
                     ed.selection.setContent("[buttonBlack][button link=\"\"]" + ed.selection.getContent() + "[/button][/buttonBlack]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('buttonBlack', tinymce.plugins.buttonBlack);
})();
/*buttonWhite*/
/*buttonBlue*/
(function() {
    tinymce.create('tinymce.plugins.buttonBlue', {
        init : function(ed, url) {
            ed.addButton('buttonBlue', {
                title : 'Blue Button',
                image : url+'/shortcodesImg/buttonBlue.png',
                onclick : function() {
                     ed.selection.setContent("[buttonBlue][button link=\"\"]" + ed.selection.getContent() + "[/button][/buttonBlue]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('buttonBlue', tinymce.plugins.buttonBlue);
})();
/*buttonBlue*/
/*buttonGreen*/
(function() {
    tinymce.create('tinymce.plugins.buttonGreen', {
        init : function(ed, url) {
            ed.addButton('buttonGreen', {
                title : 'Green Button',
                image : url+'/shortcodesImg/buttonGreen.png',
                onclick : function() {
                     ed.selection.setContent("[buttonGreen][button link=\"\"]" + ed.selection.getContent() + "[/button][/buttonGreen]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('buttonGreen', tinymce.plugins.buttonGreen);
})();
/*buttonGreen*/
/*buttonOrange*/
(function() {
    tinymce.create('tinymce.plugins.buttonOrange', {
        init : function(ed, url) {
            ed.addButton('buttonOrange', {
                title : 'Orange Button',
                image : url+'/shortcodesImg/buttonOrange.png',
                onclick : function() {
                     ed.selection.setContent("[buttonOrange][button link=\"\"]" + ed.selection.getContent() + "[/button][/buttonOrange]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('buttonOrange', tinymce.plugins.buttonOrange);
})();
/*buttonOrange*/
/*buttonRed*/
(function() {
    tinymce.create('tinymce.plugins.buttonRed', {
        init : function(ed, url) {
            ed.addButton('buttonRed', {
                title : 'Red Button',
                image : url+'/shortcodesImg/buttonRed.png',
                onclick : function() {
                     ed.selection.setContent("[buttonRed][button link=\"\"]" + ed.selection.getContent() + "[/button][/buttonRed]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('buttonRed', tinymce.plugins.buttonRed);
})();
/*buttonOrange*/

/*tours*/
(function() {
    tinymce.create('tinymce.plugins.tours', {
        init : function(ed, url) {
            ed.addButton('tours', {
                title : 'Tours',
                image : url+'/shortcodesImg/tours.png',
                onclick : function() {
                     ed.selection.setContent("[tours]"); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('tours', tinymce.plugins.tours);
})();
/*tours*/
/*fontAwesome*/
(function() {
    tinymce.create('tinymce.plugins.fontAwesome', {
        init : function(ed, url) {
            ed.addButton('fontAwesome', {
                title : 'Font Awesome',
                image : url+'/shortcodesImg/fontAwesome.png',
                onclick : function() {
                    ed.selection.setContent("[fontAwesome name=\"\" size=\"\"][/fontAwesome]");
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('fontAwesome', tinymce.plugins.fontAwesome);
})();
/*fontAwesome*/
/*column_1_2*/
(function() {
    tinymce.create('tinymce.plugins.column_1_2', {
        init : function(ed, url) {
            ed.addButton('column_1_2', {
                title : 'Column 1/2',
                image : url+'/shortcodesImg/1_2.png',
                onclick : function() {
                    ed.selection.setContent("[column_1_2]" + ed.selection.getContent() + "[/column_1_2]");
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('column_1_2', tinymce.plugins.column_1_2);
})();
/*column_1_2*/
/*column_1_3*/
(function() {
    tinymce.create('tinymce.plugins.column_1_3', {
        init : function(ed, url) {
            ed.addButton('column_1_3', {
                title : 'Column 1/3',
                image : url+'/shortcodesImg/1_3.png',
                onclick : function() {
                    ed.selection.setContent("[column_1_3]" + ed.selection.getContent() + "[/column_1_3]");
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('column_1_3', tinymce.plugins.column_1_3);
})();
/*column_1_3*/
/*column_1_4*/
(function() {
    tinymce.create('tinymce.plugins.column_1_4', {
        init : function(ed, url) {
            ed.addButton('column_1_4', {
                title : 'Column 1/4',
                image : url+'/shortcodesImg/1_4.png',
                onclick : function() {
                    ed.selection.setContent("[column_1_4]" + ed.selection.getContent() + "[/column_1_4]");
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('column_1_4', tinymce.plugins.column_1_4);
})();
/*column_1_4*/
/*column_1_6*/
(function() {
    tinymce.create('tinymce.plugins.column_1_6', {
        init : function(ed, url) {
            ed.addButton('column_1_6', {
                title : 'Column 1/6',
                image : url+'/shortcodesImg/1_6.png',
                onclick : function() {
                    ed.selection.setContent("[column_1_6]" + ed.selection.getContent() + "[/column_1_6]");
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('column_1_6', tinymce.plugins.column_1_6);
})();
/*column_1_6*/
/*Slider*/
(function() {
    tinymce.create('tinymce.plugins.Slider', {
        init : function(ed, url) {
            ed.addButton('Slider', {
                title : 'Slider',
                image : url+'/shortcodesImg/gallery.png',
                onclick : function() {
                    ed.selection.setContent("[Slider name=\"\"]");
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('Slider', tinymce.plugins.Slider);
})();
/*Slider*/