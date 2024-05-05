( function(){
    tinymce.PluginManager.add( 'fast_mce', function( editor ){
        editor.addButton( 'fast_mce', {
            text: 'FAST',
            icon: 'icon bx bxl-codepen',
            type: 'menubutton',
            menu: [
                {
                    /**
                     * Create shortcode MCE Button
                     * 
                     * @package silohon-fast
                     */
                    text: 'FAQs',
                    icon: 'icon bx bxs-message-dots',
                    onclick: function(){
                        var faqsBody = [];

                        editor.windowManager.open({
                            title: 'Add FAQs',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'faqTitle',
                                    label: 'Title',
                                    minWidth: 380,
                                    value: 'FAQs'
                                }, {
                                    type: 'textbox',
                                    name: 'faqIntroduction',
                                    label: 'Intoduction',
                                    value: '',
                                    multiline: true,
                                    minHeight: 80
                                }, {
                                    type: 'textbox',
                                    name: 'faqValue',
                                    label: 'Q & A',
                                    value: '',
                                    multiline: true,
                                    minHeight: 80
                                }, {
                                    type: 'textbox',
                                    name: 'question',
                                    label: 'Question',
                                    value: '',
                                }, {
                                    type: 'textbox',
                                    name: 'answer',
                                    label: 'Answer',
                                    value: '',
                                    multiline: true,
                                    minHeight: 80
                                }, {
                                    type: 'button',
                                    text: 'Push Q&A',
                                    maxWidth: 80,
                                    onclick: function(){
                                        var tanya = editor.windowManager.getWindows()[0].find('#question').value();
                                        var jawab = editor.windowManager.getWindows()[0].find('#answer').value();

                                        if(tanya&& jawab ){
                                            var pushItem = '<p>[faq_q]'+ tanya +'[/faq_q]</p>\n<p>[faq_a]'+ jawab +'[/faq_a]</p>\n';
                                            faqsBody.push( pushItem );

                                            var useItem = editor.windowManager.getWindows()[0].find('#faqValue');
                                            useItem.value( faqsBody.join('\n') );

                                            editor.windowManager.getWindows()[0].find('#question').value('');
                                            editor.windowManager.getWindows()[0].find('#answer').value('');
                                        }
                                    }
                                }
                            ],
                            onsubmit: function( e ){
                                var judul = e.data.faqTitle;
                                var intro = e.data.faqIntroduction;
                                var isi = e.data.faqValue;

                                var onPush = '<p>[add_faq judul="'+judul+'" paragraf="'+intro+'"]</p>'+isi+'<p>[/add_faq]</p>';
                                editor.insertContent( onPush );
                            }
                        })
                    }
                },

                {
                    /**
                     * Youtube Tiny MCE Button
                     * 
                     * @package silohon-fast
                     */
                    text: ' Youtube Embed',
                    icon: 'icon bx bxl-youtube',
                    onclick: function(){
                        editor.windowManager.open({
                            title: 'Ease Embed Youtube Video',
                            body: {
                                type: 'textbox',
                                name: 'ytID',
                                label: 'Video ID',
                                value: '',
                                minWidth: 380
                            },
                            onsubmit: function( e ){
                                var yID = e.data.ytID;

                                editor.insertContent('<p>[add_youtube videoid="'+yID+'"]</p>');
                            }
                        })
                    }
                }
            ]
        });
    });
})();