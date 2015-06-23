tinyMCE.init({
            language : "cs",
            entity_encoding : "named",
            mode: "specific_textareas",
            editor_selector: "mceEditor",
            theme : "advanced",
            plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
            theme_advanced_buttons1 : "cut,copy,paste,|,fullscreen,preview,|,undo,redo,|,code,attribs,link,unlink,print,tablecontrols,image",
            theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,forecolor,backcolor,,bullist,numlist,sub,sup",
            theme_advanced_buttons3 : "",

            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,
            file_browser_callback : "tinyBrowser",
            relative_urls: true,
            convert_urls : true,
            urlconverter_callback : "myCustomURLConverter"
        });
        function myCustomURLConverter(url, node, on_save) {
            url = url.replace('%7B', '{', 'g');
            url = url.replace('%7D', '}', 'g');
            url = url.replace('%20', ' ', 'g');
            url = url.replace('%27', '\'', 'g');
             return url;}


