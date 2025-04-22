jQuery(document).ready(function($) {
    if (typeof wp === 'undefined' || !wp.media) {
        console.error('wp.media is not available');
        return;
    }
    console.log('wp.media is available, extending media frame');

    // Define a custom view for the Insert from URL content
    var InsertFromUrlView = wp.media.View.extend({
        className: 'uc-insert-from-url-view',
        template: wp.media.template('uc-insert-from-url'),
        initialize: function(options) {
            this.options = options || {};
            console.log('InsertFromUrlView initialized with options:', this.options);
        },
        render: function() {
            console.log('Rendering InsertFromUrlView');
            try {
                this.$el.html(this.template());
                this.prefillUrl(); // Prefill the URL if available
                this.attachEventListeners();
            } catch (e) {
                console.error('Error rendering template:', e);
                this.$el.html('<p>Error loading Insert from URL content.</p>');
            }
            return this;
        },
        prefillUrl: function() {
            var view = this;
            var existingUrl = this.options.existingUrl || '';

            // For featured images, fetch from post meta
            if (this.options.context === 'featured-image' && !existingUrl) {
                $.post(ucMediaSettings.ajaxurl, {
                    action: 'uc_get_external_featured_image',
                    post_id: ucMediaSettings.postId,
                    _wpnonce: ucMediaSettings.nonce
                }).done(function(response) {
                    if (response.success && response.data.url) {
                        view.$('#uc-media-url').val(response.data.url).trigger('input');
                    }
                });
            } else if (existingUrl) {
                view.$('#uc-media-url').val(existingUrl).trigger('input');
            }
        },
        attachEventListeners: function() {
            var view = this;
            var $urlInput = this.$('#uc-media-url');
            var $previewImg = this.$('#uc-preview-img');
            var $loading = this.$('#uc-loading');
            var $insertBtn = this.$('#uc-insert-url-btn');

            $urlInput.off('input').on('input', function() {
                var url = $(this).val().trim();
                if (url && /^https?:\/\/.+\.(jpg|jpeg|png|gif|webp)$/i.test(url)) {
                    $loading.show();
                    $insertBtn.prop('disabled', true);
                    $previewImg.attr('src', url).on('load', function() {
                        $loading.hide();
                        $insertBtn.prop('disabled', false);
                        $previewImg.show();
                    }).on('error', function() {
                        $loading.hide();
                        $insertBtn.prop('disabled', true);
                        $previewImg.attr('src', '').hide();
                    });
                } else {
                    $loading.hide();
                    $insertBtn.prop('disabled', true);
                    $previewImg.attr('src', '').hide();
                }
            });

            $insertBtn.off('click').on('click', function(e) {
                e.preventDefault();
                var url = $urlInput.val().trim();
                if (!url || !/^https?:\/\/.+\.(jpg|jpeg|png|gif|webp)$/i.test(url)) return;

                console.log('Inserting URL:', url);
                var attachment = new wp.media.model.Attachment({
                    id: Date.now(),
                    url: url,
                    src: url,
                    title: 'External Image',
                    mime: 'image/' + url.split('.').pop().toLowerCase()
                });

                var frame = wp.media.frame;
                if (frame) {
                    frame.state().get('selection').reset();
                    frame.state().get('selection').add(attachment);

                    if (frame.options.state === 'insert') {
                        var imageHTML = '<img src="' + url + '" alt="" />';
                        window.send_to_editor(imageHTML);
                        frame.close();
                    } else if (frame.options.state === 'featured-image') {
                        $.post(ucMediaSettings.ajaxurl, {
                            action: 'uc_set_external_featured_image',
                            post_id: wp.media.view.settings.post.id,
                            url: url,
                            _wpnonce: ucMediaSettings.nonce
                        }).done(function(response) {
                            if (response.success) {
                                console.log('Featured image set successfully');
                                frame.close();
                            } else {
                                console.error('Failed to set featured image');
                            }
                        }).fail(function() {
                            console.error('AJAX request failed');
                        });
                    } else {
                        // Trigger selection for custom blocks
                        frame.trigger('select');
                        frame.close();
                    }
                }
            });
        }
    });

    var originalMediaFrame = wp.media.view.MediaFrame.Select;
    wp.media.view.MediaFrame.Select = originalMediaFrame.extend({
        createStates: function() {
            originalMediaFrame.prototype.createStates.apply(this, arguments);
            console.log('Adding Insert from URL state');
            this.states.add([
                new wp.media.controller.State({
                    id: 'uc-insert-from-url',
                    title: 'Insert from URL',
                    priority: 40,
                    content: 'uc-insert-from-url',
                    menu: 'default'
                })
            ]);
        },
        bindHandlers: function() {
            originalMediaFrame.prototype.bindHandlers.apply(this, arguments);
            this.on('router:render:browse', this.renderRouter, this);
            this.on('content:render:uc-insert-from-url', this.renderInsertFromUrl, this);
            this.on('open', this.onOpen, this);
        },
        renderRouter: function(routerView) {
            console.log('Rendering router with Insert from URL');
            routerView.set({
                'browse': {
                    text: 'Media Library',
                    priority: 20
                },
                'uc-insert-from-url': {
                    text: 'Insert from URL',
                    priority: 40
                }
            });
        },
        renderInsertFromUrl: function() {
            console.log('Rendering Insert from URL content');
            var view = new InsertFromUrlView({
                context: this.options.state,
                existingUrl: this.options.existingUrl || ''
            });
            this.content.set(view);
        },
        onOpen: function() {
            console.log('Media frame opened');
            if (this.state().id === 'uc-insert-from-url') {
                this.renderInsertFromUrl();
            }
        }
    });
});