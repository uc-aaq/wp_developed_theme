// uC-Blockquote Starts
wp.blocks.registerBlockType('ucertify/uc-blockquote', {
    title: 'uC-Blockquote',
    icon: 'format-quote',
    category: 'ucertify-widgets',
    attributes: {
        quote: { type: 'string', default: 'A well-known quote, contained in a blockquote element.' },
        author: { type: 'string', default: 'Someone famous' },
        source: { type: 'string', default: 'Source Title' },
    },
    edit: function(props) {
        return wp.element.createElement(
            'div',
            { className: 'uc-blockquote-editor' },
            wp.element.createElement(
                'blockquote',
                { className: 'blockquote' },
                wp.element.createElement(wp.blockEditor.RichText, {
                    tagName: 'p',
                    value: props.attributes.quote,
                    onChange: function(newQuote) { props.setAttributes({ quote: newQuote }); },
                    placeholder: 'Enter quote here...',
                }),
                wp.element.createElement(
                    'figcaption',
                    { className: 'blockquote-footer' },
                    wp.element.createElement(wp.blockEditor.RichText, {
                        tagName: 'span',
                        value: props.attributes.author,
                        onChange: function(newAuthor) { props.setAttributes({ author: newAuthor }); },
                        placeholder: 'Author name',
                    }),
                    ' in ',
                    wp.element.createElement(wp.blockEditor.RichText, {
                        tagName: 'cite',
                        value: props.attributes.source,
                        onChange: function(newSource) { props.setAttributes({ source: newSource }); },
                        placeholder: 'Source title',
                    })
                )
            )
        );
    },
    save: function(props) {
        return wp.element.createElement(
            'figure',
            null,
            wp.element.createElement(
                'blockquote',
                { className: 'blockquote' },
                wp.element.createElement('p', null, props.attributes.quote)
            ),
            wp.element.createElement(
                'figcaption',
                { className: 'blockquote-footer' },
                props.attributes.author,
                ' in ',
                wp.element.createElement('cite', { title: props.attributes.source }, props.attributes.source)
            )
        );
    },
});
// uC-Blockquote Ends

// uC-Table
wp.blocks.registerBlockType('ucertify/uc-table', {
    title: 'uC-Table',
    icon: 'editor-table',
    category: 'ucertify-widgets',
    attributes: {
        variant: { type: 'string', default: 'success' },
        headers: { type: 'array', default: ['#', 'First Name', 'Last Name', 'Position', 'Phone'] },
        rows: {
            type: 'array',
            default: [
                ['1', 'John', 'Doe', 'CEO, Founder', '+3 555 68 70'],
                ['2', 'Anna', 'Cabana', 'Designer', '+3 434 65 93'],
            ],
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { variant, headers, rows } = attributes;

        const variantOptions = [
            { label: 'Success', value: 'success' },
            { label: 'Danger', value: 'danger' },
            { label: 'Info', value: 'info' },
            { label: 'Warning', value: 'warning' },
            { label: 'Dark', value: 'dark' },
        ];

        return wp.element.createElement(
            'div',
            { className: 'uc-table-editor' },
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'Table Settings' },
                    wp.element.createElement(wp.components.SelectControl, {
                        label: 'Table Variant',
                        value: variant,
                        options: variantOptions,
                        onChange: (newVariant) => setAttributes({ variant: newVariant }),
                    })
                )
            ),
            wp.element.createElement(
                'div',
                { className: 'table-responsive' },
                wp.element.createElement(
                    'table',
                    { className: `table table-hover ${variant === 'dark' ? 'table-dark table-striped-columns' : 'table-striped-columns table-bordered border-' + variant}` },
                    wp.element.createElement(
                        'thead',
                        null,
                        wp.element.createElement(
                            'tr',
                            null,
                            headers.map((header, index) =>
                                wp.element.createElement(
                                    'th',
                                    { key: `header-${index}` },
                                    wp.element.createElement(wp.blockEditor.RichText, {
                                        tagName: 'span',
                                        value: header,
                                        onChange: (value) => {
                                            const newHeaders = [...headers];
                                            newHeaders[index] = value;
                                            setAttributes({ headers: newHeaders });
                                        },
                                        placeholder: `Column ${index + 1}`,
                                    }),
                                    wp.element.createElement(
                                        'button',
                                        {
                                            className: 'remove-column-btn',
                                            onClick: () => {
                                                if (headers.length > 1) {
                                                    const newHeaders = headers.filter((_, i) => i !== index);
                                                    const newRows = rows.map(row => row.filter((_, i) => i !== index));
                                                    setAttributes({ headers: newHeaders, rows: newRows });
                                                }
                                            },
                                        },
                                        '×'
                                    )
                                )
                            ),
                            wp.element.createElement(
                                'th',
                                null,
                                wp.element.createElement(
                                    wp.components.Button,
                                    {
                                        isPrimary: true,
                                        onClick: () => {
                                            setAttributes({ headers: [...headers, 'New Column'] });
                                            const newRows = rows.map(row => [...row, '']);
                                            setAttributes({ rows: newRows });
                                        },
                                    },
                                    '+ Column'
                                )
                            )
                        )
                    ),
                    wp.element.createElement(
                        'tbody',
                        null,
                        rows.map((row, rowIndex) =>
                            wp.element.createElement(
                                'tr',
                                { key: `row-${rowIndex}` },
                                row.map((cell, colIndex) =>
                                    wp.element.createElement(
                                        colIndex === 0 ? 'th' : 'td',
                                        { key: `cell-${rowIndex}-${colIndex}` },
                                        wp.element.createElement(wp.blockEditor.RichText, {
                                            tagName: 'span',
                                            value: cell,
                                            onChange: (value) => {
                                                const newRows = [...rows];
                                                newRows[rowIndex][colIndex] = value;
                                                setAttributes({ rows: newRows });
                                            },
                                            placeholder: `Row ${rowIndex + 1}, Col ${colIndex + 1}`,
                                        })
                                    )
                                ),
                                wp.element.createElement(
                                    'td',
                                    null,
                                    wp.element.createElement(
                                        wp.components.Button,
                                        {
                                            isDestructive: true,
                                            onClick: () => {
                                                const newRows = rows.filter((_, i) => i !== rowIndex);
                                                setAttributes({ rows: newRows.length > 0 ? newRows : [Array(headers.length).fill('')] });
                                            },
                                        },
                                        'Remove'
                                    )
                                )
                            )
                        ),
                        wp.element.createElement(
                            'tr',
                            null,
                            wp.element.createElement(
                                'td',
                                { colSpan: headers.length + 1 },
                                wp.element.createElement(
                                    wp.components.Button,
                                    {
                                        isSecondary: true,
                                        onClick: () => {
                                            setAttributes({ rows: [...rows, Array(headers.length).fill('')] });
                                        },
                                    },
                                    '+ Row'
                                )
                            )
                        )
                    )
                )
            )
        );
    },
    save: function(props) {
        const { variant, headers, rows } = props.attributes;
        return wp.element.createElement(
            'div',
            { className: 'table-responsive' },
            wp.element.createElement(
                'table',
                { className: `table table-hover ${variant === 'dark' ? 'table-dark table-striped-columns' : 'table-striped-columns table-bordered border-' + variant}` },
                wp.element.createElement(
                    'thead',
                    null,
                    wp.element.createElement(
                        'tr',
                        null,
                        headers.map((header, index) =>
                            wp.element.createElement('th', { scope: 'col', key: index }, header)
                        )
                    )
                ),
                wp.element.createElement(
                    'tbody',
                    null,
                    rows.map((row, rowIndex) =>
                        wp.element.createElement(
                            'tr',
                            { key: rowIndex },
                            row.map((cell, colIndex) =>
                                wp.element.createElement(
                                    colIndex === 0 ? 'th' : 'td',
                                    { scope: colIndex === 0 ? 'row' : null, key: colIndex },
                                    cell
                                )
                            )
                        )
                    )
                )
            )
        );
    },
});
// uC-Table Ends

// uC-Table-2 Starts
wp.blocks.registerBlockType('ucertify/uc-table-2', {
    title: 'uC Table 2',
    icon: 'editor-table',
    category: 'ucertify-widgets',
    attributes: {
        headers: {
            type: 'array',
            default: ['Certifications', 'Salary'],
        },
        rows: {
            type: 'array',
            default: [
                ['Lorem Ipsum Alpha', '$10K'],
                ['Dolor Sit Beta', '$25K'],
                ['Amet Consectetur Gamma', '$40K'],
                ['Adipiscing Elit Delta', '$30K'],
                ['Sed Do Epsilon', '$55K'],
                ['Tempor Incididunt Zeta', '$38K'],
                ['Ut Labore Eta', '$65K'],
                ['Et Dolore Theta', '$42K'],
                ['Magna Aliqua Iota', '$76K'],
                ['Quis Nostrud Kappa', '$80K'],
                ['Exercitation Lambda', '$60K'],
                ['Ullamco Laboris Mu', '$90K'],
                ['Nisi Ut Aliquip Nu', '$100K'],
            ],
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { headers, rows } = attributes;

        const addColumn = () => {
            setAttributes({ headers: [...headers, 'New Column'] });
            const newRows = rows.map(row => [...row, '']);
            setAttributes({ rows: newRows });
        };

        const removeColumn = (index) => {
            if (headers.length > 1) {
                const newHeaders = headers.filter((_, i) => i !== index);
                const newRows = rows.map(row => row.filter((_, i) => i !== index));
                setAttributes({ headers: newHeaders, rows: newRows });
            }
        };

        const addRow = () => {
            setAttributes({ rows: [...rows, Array(headers.length).fill('')] });
        };

        const removeRow = (index) => {
            const newRows = rows.filter((_, i) => i !== index);
            setAttributes({ rows: newRows.length > 0 ? newRows : [Array(headers.length).fill('')] });
        };

        const updateHeader = (index, value) => {
            const newHeaders = [...headers];
            newHeaders[index] = value;
            setAttributes({ headers: newHeaders });
        };

        const updateCell = (rowIndex, colIndex, value) => {
            const newRows = [...rows];
            newRows[rowIndex][colIndex] = value;
            setAttributes({ rows: newRows });
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-table-2-editor' },
            wp.element.createElement(
                'div',
                { className: 'table-responsive mb-2' },
                wp.element.createElement(
                    'table',
                    { className: 'table table-sm mb-0 uc-block-table' },
                    wp.element.createElement(
                        'thead',
                        null,
                        wp.element.createElement(
                            'tr',
                            null,
                            headers.map((header, index) =>
                                wp.element.createElement(
                                    'th',
                                    { key: `header-${index}` },
                                    wp.element.createElement(wp.blockEditor.RichText, {
                                        tagName: 'span',
                                        value: header,
                                        onChange: (value) => updateHeader(index, value),
                                        placeholder: `Column ${index + 1}`,
                                    }),
                                    wp.element.createElement(
                                        'button',
                                        {
                                            className: 'remove-column-btn',
                                            onClick: () => removeColumn(index),
                                        },
                                        '×'
                                    )
                                )
                            ),
                            wp.element.createElement(
                                'th',
                                null,
                                wp.element.createElement(wp.components.Button, {
                                    isPrimary: true,
                                    onClick: addColumn,
                                }, '+ Column')
                            )
                        )
                    ),
                    wp.element.createElement(
                        'tbody',
                        null,
                        rows.map((row, rowIndex) =>
                            wp.element.createElement(
                                'tr',
                                { key: `row-${rowIndex}` },
                                row.map((cell, colIndex) =>
                                    wp.element.createElement(
                                        'td', // Changed to 'td' for all cells in tbody
                                        { key: `cell-${rowIndex}-${colIndex}` },
                                        wp.element.createElement(wp.blockEditor.RichText, {
                                            tagName: 'span',
                                            value: cell,
                                            onChange: (value) => updateCell(rowIndex, colIndex, value),
                                            placeholder: `Row ${rowIndex + 1}, Col ${colIndex + 1}`,
                                        })
                                    )
                                ),
                                wp.element.createElement(
                                    'td',
                                    null,
                                    wp.element.createElement(wp.components.Button, {
                                        isDestructive: true,
                                        onClick: () => removeRow(rowIndex),
                                    }, 'Remove')
                                )
                            )
                        ),
                        wp.element.createElement(
                            'tr',
                            null,
                            wp.element.createElement(
                                'td',
                                { colSpan: headers.length + 1 },
                                wp.element.createElement(wp.components.Button, {
                                    isSecondary: true,
                                    onClick: addRow,
                                }, '+ Row')
                            )
                        )
                    )
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { headers, rows } = attributes;

        return wp.element.createElement(
            'div',
            { className: 'table-responsive mb-2' },
            wp.element.createElement(
                'table',
                { className: 'table table-sm mb-0 uc-block-table' },
                wp.element.createElement(
                    'thead',
                    null,
                    wp.element.createElement(
                        'tr',
                        null,
                        headers.map((header, index) =>
                            wp.element.createElement('th', { key: index }, header)
                        )
                    )
                ),
                wp.element.createElement(
                    'tbody',
                    null,
                    rows.map((row, rowIndex) =>
                        wp.element.createElement(
                            'tr',
                            { key: rowIndex },
                            row.map((cell, colIndex) =>
                                wp.element.createElement('td', { key: colIndex }, cell) // Changed to 'td' for all cells
                            )
                        )
                    )
                )
            )
        );
    },
});
// uC-Table-2 Ends

// uCertify CTA - 1 (Updated with Dynamic Theme URI)
wp.blocks.registerBlockType('ucertify/uc-cta-1', {
    title: 'uCertify CTA - 1',
    icon: 'megaphone',
    category: 'ucertify-widgets',
    attributes: {
        heading: { type: 'string', default: 'Edit The Heading Text' },
        text: { type: 'string', default: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' },
        buttonText: { type: 'string', default: 'Link To Redirect' },
        buttonUrl: { type: 'string', default: '#' },
        variant: { type: 'string', default: 'wavy' }, // New attribute for variant
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { heading, text, buttonText, buttonUrl, variant } = attributes;

        // Variant options for the dropdown
        const variantOptions = [
            { label: 'Wavy (With Background)', value: 'wavy' },
            { label: 'Normal (No Background)', value: 'normal' },
        ];

        return wp.element.createElement(
            'div',
            { className: 'uc-cta-editor' },
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'CTA Settings' },
                    wp.element.createElement(wp.components.SelectControl, {
                        label: 'CTA Variant',
                        value: variant,
                        options: variantOptions,
                        onChange: (newVariant) => setAttributes({ variant: newVariant }),
                    }),
                    wp.element.createElement(wp.components.TextControl, {
                        label: 'Button URL',
                        value: buttonUrl,
                        onChange: (newUrl) => setAttributes({ buttonUrl: newUrl }),
                        placeholder: 'Enter URL here...',
                    })
                )
            ),
            wp.element.createElement(
                'section',
                { className: 'container mt-n2' },
                wp.element.createElement(
                    'div',
                    { className: 'card border-0 bg-gradient-primary' },
                    wp.element.createElement(
                        'div',
                        {
                            className: 'card-body p-md-5 p-4 bg-size-cover',
                            style: variant === 'wavy' ? { backgroundImage: `url(${ucBlockData.themeUrl}/assets/img/landing/digital-agency/contact-bg.png)` } : {},
                        },
                        wp.element.createElement(
                            'div',
                            { className: 'py-md-5 py-4 text-center' },
                            wp.element.createElement(wp.blockEditor.RichText, {
                                tagName: 'h3',
                                className: 'h2 text-light',
                                value: heading,
                                onChange: (newHeading) => setAttributes({ heading: newHeading }),
                                placeholder: 'Enter heading here...',
                            }),
                            wp.element.createElement(wp.blockEditor.RichText, {
                                tagName: 'p',
                                className: 'text-light',
                                value: text,
                                onChange: (newText) => setAttributes({ text: newText }),
                                placeholder: 'Enter text here...',
                            }),
                            wp.element.createElement(wp.blockEditor.RichText, {
                                tagName: 'a',
                                className: 'btn btn-lg btn-light',
                                value: buttonText,
                                onChange: (newButtonText) => setAttributes({ buttonText: newButtonText }),
                                placeholder: 'Enter button text...',
                                href: buttonUrl,
                            })
                        )
                    )
                )
            )
        );
    },
    save: function(props) {
        const { heading, text, buttonText, buttonUrl, variant } = props.attributes;
        return wp.element.createElement(
            'section',
            { className: 'container mt-n2' },
            wp.element.createElement(
                'div',
                { className: 'card border-0 bg-gradient-primary' },
                wp.element.createElement(
                    'div',
                    {
                        className: 'card-body p-md-5 p-4 bg-size-cover',
                        style: variant === 'wavy' ? { backgroundImage: `url(${ucBlockData.themeUrl}/assets/img/landing/digital-agency/contact-bg.png)` } : {},
                    },
                    wp.element.createElement(
                        'div',
                        { className: 'py-md-5 py-4 text-center' },
                        wp.element.createElement('h3', { className: 'h2 text-light' }, heading),
                        wp.element.createElement('p', { className: 'text-light' }, text),
                        wp.element.createElement('a', { href: buttonUrl, className: 'btn btn-lg btn-light' }, buttonText)
                    )
                )
            )
        );
    },
});

// CTA - 2
wp.blocks.registerBlockType('ucertify/uc-cta-2', {
    title: 'uCertify CTA - 2',
    icon: 'megaphone',
    category: 'ucertify-widgets',
    attributes: {
        subheading: {
            type: 'string',
            default: 'Ready to get started?'
        },
        heading: {
            type: 'string',
            default: 'Launch Your Project with Us'
        },
        buttonText: {
            type: 'string',
            default: 'Work with us'
        },
        buttonUrl: {
            type: 'string',
            default: '#'
        },
        variant: {
            type: 'string',
            default: 'with-gradient'
        }
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { subheading, heading, buttonText, buttonUrl, variant } = attributes;

        const variantOptions = [
            { label: 'With Gradient', value: 'with-gradient' },
            { label: 'Without Gradient', value: 'without-gradient' }
        ];

        return wp.element.createElement(
            'div',
            { className: 'uc-cta-editor' },
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'CTA Settings' },
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'CTA Variant',
                            value: variant,
                            options: variantOptions,
                            onChange: (newVariant) => setAttributes({ variant: newVariant })
                        }
                    ),
                    wp.element.createElement(
                        wp.components.TextControl,
                        {
                            label: 'Button URL',
                            value: buttonUrl,
                            onChange: (newUrl) => setAttributes({ buttonUrl: newUrl }),
                            placeholder: 'Enter URL here...'
                        }
                    )
                )
            ),
            wp.element.createElement(
                'section',
                { className: 'container' },
                wp.element.createElement(
                    'div',
                    {
                        className: `position-relative rounded-3 overflow-hidden px-3 py-5 ${variant === 'with-gradient' ? '' : 'bg-dark'}`,
                        style: variant === 'with-gradient' ? { backgroundImage: `url(${ucBlockData.themeUrl}/assets/img/landing/saas-3/hero/hero-bg.jpg)`, backgroundSize: 'cover' } : {}
                    },
                    wp.element.createElement(
                        'span',
                        { className: 'position-absolute top-0 start-0 w-100 h-100', style: { backgroundColor: 'rgba(255, 255, 255, .05)' } }
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'position-relative zindex-5 text-center my-xl-3 py-1 py-md-4 py-lg-5' },
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'p',
                                className: 'lead text-light opacity-70 mb-3',
                                value: subheading,
                                onChange: (newSubheading) => setAttributes({ subheading: newSubheading }),
                                placeholder: 'Enter subheading here...'
                            }
                        ),
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'h2',
                                className: 'h1 text-light pb-3 pb-lg-0 mb-lg-5',
                                value: heading,
                                onChange: (newHeading) => setAttributes({ heading: newHeading }),
                                placeholder: 'Enter heading here...'
                            }
                        ),
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'a',
                                className: 'btn btn-primary btn-lg',
                                value: buttonText,
                                onChange: (newButtonText) => setAttributes({ buttonText: newButtonText }),
                                placeholder: 'Enter button text...',
                                href: buttonUrl
                            }
                        )
                    )
                )
            )
        );
    },
    save: function(props) {
        const { subheading, heading, buttonText, buttonUrl, variant } = props.attributes;

        return wp.element.createElement(
            'section',
            { className: 'container' },
            wp.element.createElement(
                'div',
                {
                    className: `position-relative rounded-3 overflow-hidden px-3 py-5 ${variant === 'with-gradient' ? '' : 'bg-dark'}`,
                    style: variant === 'with-gradient' ? { backgroundImage: `url(${ucBlockData.themeUrl}/assets/img/landing/saas-3/hero/hero-bg.jpg)`, backgroundSize: 'cover' } : {}
                },
                wp.element.createElement(
                    'span',
                    { className: 'position-absolute top-0 start-0 w-100 h-100', style: { backgroundColor: 'rgba(255, 255, 255, .05)' } }
                ),
                wp.element.createElement(
                    'div',
                    { className: 'position-relative zindex-5 text-center my-xl-3 py-1 py-md-4 py-lg-5' },
                    wp.element.createElement(
                        'p',
                        { className: 'lead text-light opacity-70 mb-3' },
                        subheading
                    ),
                    wp.element.createElement(
                        'h2',
                        { className: 'h1 text-light pb-3 pb-lg-0 mb-lg-5' },
                        heading
                    ),
                    wp.element.createElement(
                        'a',
                        { href: buttonUrl, className: 'btn btn-primary btn-lg' },
                        buttonText
                    )
                )
            )
        );
    }
});
// CTA - 2 Ends

// CTA - 3
wp.blocks.registerBlockType('ucertify/uc-cta-3', {
    title: 'uCertify CTA - 3',
    icon: 'megaphone',
    category: 'ucertify-widgets',
    attributes: {
        mobileHeading: { type: 'string', default: 'Heading Of The CTA' },
        desktopHeading: { type: 'string', default: 'Heading Of The CTA' },
        text: { type: 'string', default: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.' },
        buttonText: { type: 'string', default: 'Learn More' },
        buttonUrl: { type: 'string', default: '#' },
        imageUrl: { type: 'string', default: ucBlockData.themeUrl + '/assets/img/courses-placeholder-2.webp' },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { mobileHeading, desktopHeading, text, buttonText, buttonUrl, imageUrl } = attributes;

        const updateImage = () => {
            const frame = wp.media({
                title: 'Select or Upload Image',
                button: { text: 'Use this image' },
                multiple: false,
                library: { type: 'image' },
            });
            frame.on('select', () => {
                const attachment = frame.state().get('selection').first().toJSON();
                setAttributes({ imageUrl: attachment.url });
            });
            frame.open();
        };

        return wp.element.createElement(
            'section',
            { className: 'py-2 bg-primary-subtle uc-cta-3-editor' },
            wp.element.createElement(
                'div',
                { className: 'container' },
                wp.element.createElement(
                    'div',
                    { className: 'd-md-none text-center mb-4' },
                    wp.element.createElement(wp.blockEditor.RichText, {
                        tagName: 'h3',
                        className: 'h4 fw-bold mb-0',
                        value: mobileHeading,
                        onChange: (value) => setAttributes({ mobileHeading: value }),
                        placeholder: 'Enter mobile heading...',
                    })
                ),
                wp.element.createElement(
                    'div',
                    { className: 'row gx-4 align-items-center' },
                    wp.element.createElement(
                        'div',
                        { className: 'col-12 col-md-4 order-2 order-md-1 text-center text-md-start mb-4 mb-md-0' },
                        wp.element.createElement('img', {
                            src: imageUrl,
                            alt: 'Placeholder',
                            className: 'img-fluid rounded-circle',
                            style: { maxWidth: '200px' },
                            onClick: updateImage,
                            style: { cursor: 'pointer' },
                        }),
                        wp.element.createElement(wp.components.Button, {
                            isSecondary: true,
                            onClick: updateImage,
                            style: { marginTop: '10px' },
                        }, 'Change Image')
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'col-12 col-md-8 order-3 order-md-2 text-center text-md-start' },
                        wp.element.createElement(
                            'h3',
                            { className: 'h4 fw-bold mb-2 d-none d-md-block' },
                            wp.element.createElement(wp.blockEditor.RichText, {
                                tagName: 'span',
                                value: desktopHeading,
                                onChange: (value) => setAttributes({ desktopHeading: value }),
                                placeholder: 'Enter desktop heading...',
                            })
                        ),
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'p',
                            className: 'mb-3',
                            value: text,
                            onChange: (value) => setAttributes({ text: value }),
                            placeholder: 'Enter text here...',
                        }),
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'a',
                            className: 'btn btn-outline-primary',
                            value: buttonText,
                            onChange: (value) => setAttributes({ buttonText: value }),
                            placeholder: 'Enter button text...',
                        }),
                        wp.element.createElement(wp.components.TextControl, {
                            label: 'Button URL',
                            value: buttonUrl,
                            onChange: (value) => setAttributes({ buttonUrl: value }),
                            placeholder: 'Enter URL here...',
                            style: { marginTop: '10px' },
                        })
                    )
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { mobileHeading, desktopHeading, text, buttonText, buttonUrl, imageUrl } = attributes;

        return wp.element.createElement(
            'section',
            { className: 'py-2 bg-primary-subtle' },
            wp.element.createElement(
                'div',
                { className: 'container' },
                wp.element.createElement(
                    'div',
                    { className: 'd-md-none text-center mb-4' },
                    wp.element.createElement('h3', { className: 'h4 fw-bold mb-0' }, mobileHeading)
                ),
                wp.element.createElement(
                    'div',
                    { className: 'row gx-4 align-items-center' },
                    wp.element.createElement(
                        'div',
                        { className: 'col-12 col-md-4 order-2 order-md-1 text-center text-md-start mb-4 mb-md-0' },
                        wp.element.createElement('img', {
                            src: imageUrl,
                            alt: 'Placeholder',
                            className: 'img-fluid rounded-circle',
                            style: { maxWidth: '200px' },
                        })
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'col-12 col-md-8 order-3 order-md-2 text-center text-md-start' },
                        wp.element.createElement(
                            'h3',
                            { className: 'h4 fw-bold mb-2 d-none d-md-block' },
                            desktopHeading
                        ),
                        wp.element.createElement('p', { className: 'mb-3' }, text),
                        wp.element.createElement('a', { href: buttonUrl, className: 'btn btn-outline-primary' }, buttonText)
                    )
                )
            )
        );
    },
});
// CTA - 3 Ends

// uCertify Subscription Block Starts
wp.blocks.registerBlockType('ucertify/uc-subscription', {
    title: 'uC Subscription Block',
    icon: 'email-alt',
    category: 'ucertify-widgets',
    attributes: {
        heading: {
            type: 'string',
            default: 'Be the First to Know!',
        },
        text: {
            type: 'string',
            default: 'Get exclusive course previews, industry insights, and offers that’ll make you (and your wallet) happy, delivered to your inbox.',
        },
        agreement: {
            type: 'string',
            default: '* Yes, I agree to the <a href="/terms-conditions">terms</a> and <a href="/privacy-policy/">privacy policy</a>.',
        },
        variant: {
            type: 'string',
            default: 'bg-secondary',
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { heading, text, agreement, variant } = attributes;

        const variantOptions = [
            { label: 'Secondary', value: 'bg-secondary' },
            { label: 'Faded Primary', value: 'bg-faded-primary' },
            { label: 'Faded Success', value: 'bg-faded-success' },
            { label: 'Faded Warning', value: 'bg-faded-warning' },
            { label: 'Faded Danger', value: 'bg-faded-danger' },
            { label: 'Faded Info', value: 'bg-faded-info' },
            { label: 'Faded Dark', value: 'bg-faded-dark' },
            { label: 'Gradient Primary', value: 'bg-gradient-primary' },
        ];

        return wp.element.createElement(
            'div',
            { className: 'uc-subscription-editor' },
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'Subscription Block Settings' },
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'Background Variant',
                            value: variant,
                            options: variantOptions,
                            onChange: (newVariant) => setAttributes({ variant: newVariant }),
                        }
                    )
                )
            ),
            wp.element.createElement(
                'div',
                { className: `container py-md-3 py-lg-5 ${variant}` },
                wp.element.createElement(
                    'div',
                    { className: 'row justify-content-center pt-2' },
                    wp.element.createElement(
                        'div',
                        { className: 'col-xl-8 col-lg-9 col-md-11' },
                        wp.element.createElement(
                            'div',
                            { className: 'h1-wrapper position-relative' },
                            wp.element.createElement(
                                wp.blockEditor.RichText,
                                {
                                    tagName: 'h2',
                                    className: 'h1 d-md-inline-block text-sm-start text-center',
                                    value: heading,
                                    onChange: (newHeading) => setAttributes({ heading: newHeading }),
                                    placeholder: 'Enter heading here...',
                                }
                            ),
                            wp.element.createElement(
                                'svg',
                                {
                                    className: 'd-md-block d-none position-absolute top-0 ms-4 ps-1',
                                    style: { left: '100%' },
                                    xmlns: 'http://www.w3.org/2000/svg',
                                    width: '65',
                                    height: '68',
                                    fill: '#6366f1',
                                },
                                wp.element.createElement(
                                    'path',
                                    {
                                        d: 'M53.9527 51.0012c8.396-10.5668 2.0302-26.0134-11.7481-26.7511-.6899-.0646-1.4612.0015-2.1258.0431.1243 9.0462-4.1714 18.8896-11.5618 21.3814-6.6695 2.2133-10.3337-4.2224-7.5813-9.676 3.2966-6.4755 9.103-11.8504 16.1678-13.8189-.5654-5.6953-3.3436-10.7672-9.485-12.48517C17.2678 6.8204 6.49364 16.3681 4.98841 26.127c-.09276 1.0297-1.68569.9497-1.59293-.0801C3.98732 12.9139 19.7395 2.55212 31.9628 8.5787c4.7253 2.3813 7.2649 7.3963 7.9368 13.067 7.4237-.9311 14.5154 3.3683 18.3422 9.5422 4.3988 7.1623 2.3584 15.1401-2.6322 21.1108-.7826.9653-2.3331-.3572-1.6569-1.2975zM26.7754 32.1845c-1.9411 2.2411-4.076 5.0872-4.3542 8.1764-.3036 2.9829 3.7601 3.0525 5.4905 2.7645 2.1568-.3863 3.7221-2.3164 4.8863-4.0419 2.6228-3.6308 4.3657-9.0752 4.4844-14.2563-4.0808 1.279-7.6514 4.2327-10.507 7.3573zm24.6311 25.592c-.7061-2.9738-1.2243-6.1031-1.1591-9.143.0423-1.242 1.767-1.0805 1.8313.1372.1284 2.435.815 4.8532 1.4764 7.1651l4.1619-1.4098c1.0153-.4586 2.4373-1.5714 3.6544-1.1804.6087.1954.7347.7264.6475 1.3068-.2302 1.3976-2.4683 1.9147-3.5901 2.398-1.8429.7619-3.6293 1.2865-5.5477 1.7298-.6391.1476-1.3233-.3665-1.4746-1.0037z'
                                    }
                                )
                            )
                        ),
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'p',
                                className: 'fs-sm mb-4',
                                value: text,
                                onChange: (newText) => setAttributes({ text: newText }),
                                placeholder: 'Enter text here...',
                            }
                        ),
                        wp.element.createElement(
                            'form',
                            { className: 'subscribeForm d-flex flex-sm-row flex-column mb-3', novalidate: true },
                            wp.element.createElement(
                                'div',
                                { className: 'input-group me-sm-3 mb-sm-0 mb-3' },
                                wp.element.createElement(
                                    'i',
                                    { className: 'bx bx-envelope position-absolute start-0 top-50 translate-middle-y ms-3 zindex-5 fs-5 text-muted' }
                                ),
                                wp.element.createElement(
                                    'input',
                                    { type: 'email', className: 'form-control form-control-lg rounded-3 ps-5', placeholder: 'Your email', required: true }
                                )
                            ),
                            wp.element.createElement(
                                'button',
                                { type: 'submit', className: 'btn btn-lg btn-primary' },
                                'Subscribe *'
                            )
                        ),
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'div',
                                className: 'form-text fs-sm text-sm-start text-center',
                                value: agreement,
                                onChange: (newAgreement) => setAttributes({ agreement: newAgreement }),
                                placeholder: 'Enter agreement text here...',
                                allowedFormats: ['core/link'], // Links ko enable karta hai
                            }
                        )
                    )
                )
            )
        );
    },
    save: function(props) {
        const { heading, text, agreement, variant } = props.attributes;
        return wp.element.createElement(
            'div',
            { className: `container py-md-3 py-lg-5 ${variant}` },
            wp.element.createElement(
                'div',
                { className: 'row justify-content-center pt-2' },
                wp.element.createElement(
                    'div',
                    { className: 'col-xl-8 col-lg-9 col-md-11' },
                    wp.element.createElement(
                        'h2',
                        { className: 'h1 d-md-inline-block position-relative text-sm-start text-center' },
                        heading,
                        wp.element.createElement(
                            'svg',
                            {
                                className: 'd-md-block d-none position-absolute top-0 ms-4 ps-1',
                                style: { left: '100%' },
                                xmlns: 'http://www.w3.org/2000/svg',
                                width: '65',
                                height: '68',
                                fill: '#6366f1',
                            },
                            wp.element.createElement(
                                'path',
                                {
                                    d: 'M53.9527 51.0012c8.396-10.5668 2.0302-26.0134-11.7481-26.7511-.6899-.0646-1.4612.0015-2.1258.0431.1243 9.0462-4.1714 18.8896-11.5618 21.3814-6.6695 2.2133-10.3337-4.2224-7.5813-9.676 3.2966-6.4755 9.103-11.8504 16.1678-13.8189-.5654-5.6953-3.3436-10.7672-9.485-12.48517C17.2678 6.8204 6.49364 16.3681 4.98841 26.127c-.09276 1.0297-1.68569.9497-1.59293-.0801C3.98732 12.9139 19.7395 2.55212 31.9628 8.5787c4.7253 2.3813 7.2649 7.3963 7.9368 13.067 7.4237-.9311 14.5154 3.3683 18.3422 9.5422 4.3988 7.1623 2.3584 15.1401-2.6322 21.1108-.7826.9653-2.3331-.3572-1.6569-1.2975zM26.7754 32.1845c-1.9411 2.2411-4.076 5.0872-4.3542 8.1764-.3036 2.9829 3.7601 3.0525 5.4905 2.7645 2.1568-.3863 3.7221-2.3164 4.8863-4.0419 2.6228-3.6308 4.3657-9.0752 4.4844-14.2563-4.0808 1.279-7.6514 4.2327-10.507 7.3573zm24.6311 25.592c-.7061-2.9738-1.2243-6.1031-1.1591-9.143.0423-1.242 1.767-1.0805 1.8313.1372.1284 2.435.815 4.8532 1.4764 7.1651l4.1619-1.4098c1.0153-.4586 2.4373-1.5714 3.6544-1.1804.6087.1954.7347.7264.6475 1.3068-.2302 1.3976-2.4683 1.9147-3.5901 2.398-1.8429.7619-3.6293 1.2865-5.5477 1.7298-.6391.1476-1.3233-.3665-1.4746-1.0037z'
                                }
                            )
                        )
                    ),
                    wp.element.createElement(
                        'p',
                        { className: 'fs-sm mb-4' },
                        text
                    ),
                    wp.element.createElement(
                        'form',
                        { className: 'subscribeForm d-flex flex-sm-row flex-column mb-3', novalidate: true },
                        wp.element.createElement(
                            'div',
                            { className: 'input-group me-sm-3 mb-sm-0 mb-3' },
                            wp.element.createElement(
                                'i',
                                { className: 'bx bx-envelope position-absolute start-0 top-50 translate-middle-y ms-3 zindex-5 fs-5 text-muted' }
                            ),
                            wp.element.createElement(
                                'input',
                                { type: 'email', className: 'form-control form-control-lg rounded-3 ps-5', placeholder: 'Your email', required: true }
                            )
                        ),
                        wp.element.createElement(
                            'button',
                            { type: 'submit', className: 'btn btn-lg btn-primary' },
                            'Subscribe *'
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'form-text fs-sm text-sm-start text-center', dangerouslySetInnerHTML: { __html: agreement } }
                    )
                )
            )
        );
    },
});
// uCertify Subscription Block Ends

// uCertify Heading Block Starts
wp.blocks.registerBlockType('ucertify/uc-heading', {
    title: 'uC-Heading',
    icon: 'heading',
    category: 'ucertify-widgets',
    attributes: {
        content: {
            type: 'string',
            default: "I'm a heading text",
        },
        level: {
            type: 'string',
            default: 'h2', // Default to h2
        },
        variant: {
            type: 'string',
            default: 'default', // Default to "Default" style
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { content, level, variant } = attributes;

        // Options for heading level dropdown (h2 to h6)
        const levelOptions = [
            { label: 'H2', value: 'h2' },
            { label: 'H3', value: 'h3' },
            { label: 'H4', value: 'h4' },
            { label: 'H5', value: 'h5' },
            { label: 'H6', value: 'h6' },
        ];

        // Options for variant dropdown (Default or Gradient)
        const variantOptions = [
            { label: 'Default', value: 'default' },
            { label: 'Gradient', value: 'gradient' },
        ];

        return wp.element.createElement(
            'div',
            { className: 'uc-heading-editor' },
            // Inspector Controls for dropdowns
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'Heading Settings' },
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'Heading Level',
                            value: level,
                            options: levelOptions,
                            onChange: (newLevel) => setAttributes({ level: newLevel }),
                        }
                    ),
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'Style Variant',
                            value: variant,
                            options: variantOptions,
                            onChange: (newVariant) => setAttributes({ variant: newVariant }),
                        }
                    )
                )
            ),
            // Editable heading preview in the editor
            wp.element.createElement(
                wp.blockEditor.RichText,
                {
                    tagName: level, // Dynamically set h2, h3, etc.
                    className: `${level} mb-0 ${variant === 'gradient' ? 'text-gradient-primary' : ''}`,
                    value: content,
                    onChange: (newContent) => setAttributes({ content: newContent }),
                    placeholder: 'Enter heading text here...',
                    // For gradient variant, wrap content in a span in the editor preview
                    ...(variant === 'gradient' && {
                        allowedFormats: ['core/bold', 'core/italic'], // Limit formats for span
                        tagName: 'span', // Use span for gradient in editor
                        multiline: false,
                    }),
                }
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { content, level, variant } = attributes;

        // Create the heading element dynamically (h2, h3, etc.)
        if (variant === 'gradient') {
            return wp.element.createElement(
                level, // h2, h3, h4, h5, or h6
                { className: `${level} mb-0` },
                wp.element.createElement(
                    'span',
                    { className: 'text-gradient-primary' },
                    content
                )
            );
        } else {
            return wp.element.createElement(
                level, // h2, h3, h4, h5, or h6
                { className: `${level} mb-0` },
                content
            );
        }
    },
});
// uCertify Heading Block Ends

// uCertify Tabs Block Starts
wp.blocks.registerBlockType('ucertify/uc-tabs', {
    title: 'uC-Tabs',
    icon: 'editor-ul',
    category: 'ucertify-widgets',
    attributes: {
        variant: {
            type: 'string',
            default: 'default', // 'default' for nav-tabs, 'alt' for nav-tabs-alt
        },
        tabs: {
            type: 'array',
            default: [
                { title: 'Home', content: 'Raw denim you probably haven\'t heard of them jean shorts Austin...', id: 'home1' },
                { title: 'Profile', content: 'Food truck fixie locavore, accusamus mcsweeney\'s marfa nulla...', id: 'profile1' },
            ],
        },
        activeTab: {
            type: 'number',
            default: 0, // Pehla tab default active
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { variant, tabs, activeTab } = attributes;

        // Variant ke liye dropdown options
        const variantOptions = [
            { label: 'uC Tab One (nav-tabs)', value: 'default' },
            { label: 'uC Tab Two (nav-tabs-alt)', value: 'alt' },
        ];

        // Naya tab add karne ka function
        const addTab = () => {
            const newTab = {
                title: 'New Tab',
                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                id: `tab-${Date.now()}-${tabs.length}`, // Unique ID har tab ke liye
            };
            setAttributes({ tabs: [...tabs, newTab] });
        };

        // Tab remove karne ka function
        const removeTab = (index) => {
            const newTabs = tabs.filter((_, i) => i !== index);
            let newActiveTab = activeTab;
            if (index === activeTab && newTabs.length > 0) {
                newActiveTab = Math.max(0, activeTab - 1); // Agar active tab remove ho toh pichla active ho
            }
            setAttributes({ tabs: newTabs, activeTab: newActiveTab });
        };

        // Tab switch karne ka function
        const switchTab = (index) => {
            setAttributes({ activeTab: index });
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-tabs-editor' },
            // Inspector Controls mein variant dropdown
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'Tab Settings' },
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'Tab Style',
                            value: variant,
                            options: variantOptions,
                            onChange: (newVariant) => setAttributes({ variant: newVariant }),
                        }
                    )
                )
            ),
            // Tab navigation (editable titles)
            wp.element.createElement(
                'ul',
                { className: `nav ${variant === 'alt' ? 'nav-tabs-alt' : 'nav-tabs'}`, role: 'tablist' },
                tabs.map((tab, index) => wp.element.createElement(
                    'li',
                    { key: index, className: 'nav-item' },
                    wp.element.createElement(
                        'div', // 'a' ki jagah 'div' use kiya taaki editor mein link behavior na ho
                        {
                            className: `nav-link ${index === activeTab ? 'active' : ''}`,
                            onClick: () => switchTab(index), // Tab switch karne ke liye
                            style: { cursor: 'pointer' },
                        },
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'span',
                            value: tab.title,
                            onChange: (newTitle) => {
                                const newTabs = [...tabs];
                                newTabs[index].title = newTitle;
                                setAttributes({ tabs: newTabs });
                            },
                            placeholder: 'Tab title...',
                        }),
                        // Har tab ke liye remove button (pehle tab ke alawa agar chaho)
                        wp.element.createElement(
                            'button',
                            {
                                className: 'remove-tab-btn',
                                onClick: (e) => {
                                    e.stopPropagation(); // Tab switch hone se roke
                                    removeTab(index);
                                },
                            },
                            '×'
                        )
                    )
                )),
                // Add Tab button
                wp.element.createElement(
                    'li',
                    { className: 'nav-item' },
                    wp.element.createElement(
                        'button',
                        {
                            className: 'add-tab-btn',
                            onClick: addTab,
                        },
                        '+ Add Tab'
                    )
                )
            ),
            // Tab content (active tab ka hi dikhe editor mein)
            wp.element.createElement(
                'div',
                { className: 'tab-content' },
                wp.element.createElement(
                    'div',
                    {
                        className: 'tab-pane fade show active',
                        role: 'tabpanel',
                    },
                    wp.element.createElement(wp.blockEditor.RichText, {
                        tagName: 'p',
                        value: tabs[activeTab].content,
                        onChange: (newContent) => {
                            const newTabs = [...tabs];
                            newTabs[activeTab].content = newContent;
                            setAttributes({ tabs: newTabs });
                        },
                        placeholder: 'Tab content...',
                    })
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { variant, tabs } = attributes;

        // Nav tabs ke liye class decide karna
        const navClass = variant === 'alt' ? 'nav-tabs-alt' : 'nav-tabs';

        return wp.element.createElement(
            'div',
            null,
            // Nav tabs
            wp.element.createElement(
                'ul',
                { className: `nav ${navClass}`, role: 'tablist' },
                tabs.map((tab, index) => wp.element.createElement(
                    'li',
                    { key: index, className: 'nav-item' },
                    wp.element.createElement(
                        'a',
                        {
                            href: `#${tab.id}`,
                            className: `nav-link ${index === 0 ? 'active' : ''}`,
                            'data-bs-toggle': 'tab',
                            role: 'tab',
                        },
                        tab.title
                    )
                ))
            ),
            // Tabs content
            wp.element.createElement(
                'div',
                { className: 'tab-content' },
                tabs.map((tab, index) => wp.element.createElement(
                    'div',
                    {
                        key: index,
                        className: `tab-pane fade ${index === 0 ? 'show active' : ''}`,
                        id: tab.id,
                        role: 'tabpanel',
                    },
                    wp.element.createElement('p', null, tab.content)
                ))
            )
        );
    },
});
// uCertify Tabs Block Ends

// uCertify Steps Block Starts
wp.blocks.registerBlockType('ucertify/uc-steps', {
    title: 'uC Steps',
    icon: 'list-view',
    category: 'ucertify-widgets',
    attributes: {
        variant: {
            type: 'string',
            default: 'vertical', // Default variant vertical hai
        },
        steps: {
            type: 'array',
            default: [
                { number: 1, title: 'Choose your course', description: 'Nulla faucibus mauris pellentesque blandit faucibus non...' },
                { number: 2, title: 'Learn by doing', description: 'Tristique sed pharetra feugiat tempor sagittis...' },
                { number: 3, title: 'Get instant expert feedback', description: 'Duis euismod enim, facilisis risus tellus...' },
            ],
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { variant, steps } = attributes;

        // Variant options for dropdown
        const variantOptions = [
            { label: 'Vertical', value: 'vertical' },
            { label: 'Horizontal', value: 'horizontal' },
        ];

        // Function to add a new step
        const addStep = () => {
            const newStep = {
                number: steps.length + 1,
                title: 'New Step',
                description: 'Description for new step...',
            };
            setAttributes({ steps: [...steps, newStep] });
        };

        // Function to remove a step
        const removeStep = (index) => {
            const newSteps = steps.filter((_, i) => i !== index);
            setAttributes({ steps: newSteps });
        };

        // Function to update step title
        const updateStepTitle = (index, newTitle) => {
            const newSteps = [...steps];
            newSteps[index].title = newTitle;
            setAttributes({ steps: newSteps });
        };

        // Function to update step description
        const updateStepDescription = (index, newDescription) => {
            const newSteps = [...steps];
            newSteps[index].description = newDescription;
            setAttributes({ steps: newSteps });
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-steps-editor' },
            // Inspector Controls for variant selection
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'Steps Settings' },
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'Layout Variant',
                            value: variant,
                            options: variantOptions,
                            onChange: (newVariant) => setAttributes({ variant: newVariant }),
                        }
                    )
                )
            ),
            // Steps container with dynamic classes
            wp.element.createElement(
                'div',
                { className: `steps steps-sm ${variant === 'horizontal' ? 'steps-horizontal-md' : ''}` },
                steps.map((step, index) => (
                    wp.element.createElement(
                        'div',
                        { key: index, className: 'step' },
                        wp.element.createElement(
                            'div',
                            { className: 'step-number' },
                            wp.element.createElement(
                                'div',
                                { className: 'step-number-inner' },
                                step.number
                            )
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'step-body' },
                            wp.element.createElement(
                                wp.blockEditor.RichText,
                                {
                                    tagName: 'h5',
                                    className: 'mb-2',
                                    value: step.title,
                                    onChange: (newTitle) => updateStepTitle(index, newTitle),
                                    placeholder: 'Step title...',
                                }
                            ),
                            wp.element.createElement(
                                wp.blockEditor.RichText,
                                {
                                    tagName: 'p',
                                    className: 'fs-sm mb-0',
                                    value: step.description,
                                    onChange: (newDescription) => updateStepDescription(index, newDescription),
                                    placeholder: 'Step description...',
                                }
                            ),
                            wp.element.createElement(
                                wp.components.Button,
                                {
                                    isDestructive: true,
                                    onClick: () => removeStep(index),
                                },
                                'Remove Step'
                            )
                        )
                    )
                )),
                wp.element.createElement(
                    wp.components.Button,
                    {
                        isPrimary: true,
                        onClick: addStep,
                    },
                    '+ Add Step'
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { variant, steps } = attributes;

        // Classes based on variant
        const stepsClass = variant === 'horizontal' ? 'steps steps-sm steps-horizontal-md' : 'steps steps-sm';

        return wp.element.createElement(
            'div',
            { className: stepsClass },
            steps.map((step, index) => (
                wp.element.createElement(
                    'div',
                    { key: index, className: 'step' },
                    wp.element.createElement(
                        'div',
                        { className: 'step-number' },
                        wp.element.createElement(
                            'div',
                            { className: 'step-number-inner' },
                            step.number
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'step-body' },
                        wp.element.createElement(
                            'h5',
                            { className: 'mb-2' },
                            step.title
                        ),
                        wp.element.createElement(
                            'p',
                            { className: 'fs-sm mb-0' },
                            step.description
                        )
                    )
                )
            ))
        );
    },
});
// uCertify Steps Block Ends

// uCertify Pricing Block Starts
wp.blocks.registerBlockType('ucertify/uc-pricing-table', {
    title: 'uC Pricing Table',
    icon: 'money',
    category: 'ucertify-widgets',
    attributes: {
        cards: {
            type: 'array',
            default: [
                {
                    imageUrl: ucBlockData.themeUrl + '/assets/img/courses-placeholder.webp',
                    planName: 'Basic',
                    price: '$5.00',
                    pricePeriod: '/ per month',
                    features: [
                        { text: 'Aenean neque tortor, purus faucibus', type: 'included' },
                        { text: 'Nullam augue vitae et volutpat sagittis', type: 'included' },
                        { text: 'Mauris massa penatibus enim elit quam', type: 'excluded' },
                        { text: 'Nec ac sagittis nunc bibendum', type: 'excluded' },
                        { text: 'Odio ut orci volutpat ultricies eleifend', type: 'excluded' },
                    ],
                    buttonText: 'View',
                    buttonUrl: '#',
                },
                {
                    imageUrl: ucBlockData.themeUrl + '/assets/img/courses-placeholder.webp',
                    planName: 'Standard',
                    price: '$10.00',
                    pricePeriod: '/ per month',
                    features: [
                        { text: 'Aenean neque tortor, purus faucibus', type: 'included' },
                        { text: 'Nullam augue vitae et volutpat sagittis', type: 'included' },
                        { text: 'Mauris massa penatibus enim elit quam', type: 'included' },
                        { text: 'Nec ac sagittis nunc bibendum', type: 'included' },
                        { text: 'Odio ut orci volutpat ultricies eleifend', type: 'excluded' },
                    ],
                    buttonText: 'View',
                    buttonUrl: '#',
                },
                {
                    imageUrl: ucBlockData.themeUrl + '/assets/img/courses-placeholder.webp',
                    planName: 'Ultimate',
                    price: '$15.00',
                    pricePeriod: '/ per month',
                    features: [
                        { text: 'Aenean neque tortor, purus faucibus', type: 'included' },
                        { text: 'Nullam augue vitae et volutpat sagittis', type: 'included' },
                        { text: 'Mauris massa penatibus enim elit quam', type: 'included' },
                        { text: 'Nec ac sagittis nunc bibendum', type: 'included' },
                        { text: 'Odio ut orci volutpat ultricies eleifend', type: 'included' },
                    ],
                    buttonText: 'View',
                    buttonUrl: '#',
                },
            ],
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { cards } = attributes;

        // Function to add a new card (max 3)
        const addCard = () => {
            if (cards.length < 3) {
                const newCard = {
                    imageUrl: ucBlockData.themeUrl + '/assets/img/courses-placeholder.webp',
                    planName: 'New Plan',
                    price: '$0.00',
                    pricePeriod: '/ per month',
                    features: [],
                    buttonText: 'View',
                    buttonUrl: '#',
                };
                setAttributes({ cards: [...cards, newCard] });
            }
        };

        // Function to remove a card (min 1)
        const removeCard = (index) => {
            if (cards.length > 1) {
                const newCards = cards.filter((_, i) => i !== index);
                setAttributes({ cards: newCards });
            }
        };

        // Function to update card details
        const updateCard = (index, field, value) => {
            const newCards = [...cards];
            newCards[index][field] = value;
            setAttributes({ cards: newCards });
        };

        // Function to add a feature (max 10)
        const addFeature = (cardIndex) => {
            if (cards[cardIndex].features.length < 10) {
                const newFeature = { text: 'New feature', type: 'included' };
                const newCards = [...cards];
                newCards[cardIndex].features.push(newFeature);
                setAttributes({ cards: newCards });
            }
        };

        // Function to remove a feature
        const removeFeature = (cardIndex, featureIndex) => {
            const newCards = [...cards];
            newCards[cardIndex].features = newCards[cardIndex].features.filter((_, i) => i !== featureIndex);
            setAttributes({ cards: newCards });
        };

        // Function to update a feature
        const updateFeature = (cardIndex, featureIndex, field, value) => {
            const newCards = [...cards];
            newCards[cardIndex].features[featureIndex][field] = value;
            setAttributes({ cards: newCards });
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-pricing-table-editor' },
            wp.element.createElement(
                'div',
                { className: 'table-responsive-lg' },
                wp.element.createElement(
                    'div',
                    { className: 'row flex-nowrap pb-4' },
                    cards.map((card, cardIndex) => (
                        wp.element.createElement(
                            'div',
                            { key: cardIndex, className: 'col' },
                            wp.element.createElement(
                                'div',
                                { className: 'card h-100 border-0 shadow-sm p-xxl-3' },
                                wp.element.createElement(
                                    'div',
                                    { className: 'card-body' },
                                    wp.element.createElement(
                                        'div',
                                        { className: 'd-flex align-items-center pb-2 pb-md-3 mb-4' },
                                        wp.element.createElement(
                                            'div',
                                            { className: 'flex-shrink-0 bg-secondary rounded-3' },
                                            wp.element.createElement('img', {
                                                src: card.imageUrl,
                                                width: '84',
                                                alt: 'Icon',
                                                onClick: () => {
                                                    const frame = wp.media({
                                                        title: 'Select or Enter Image URL',
                                                        button: { text: 'Use this image' },
                                                        multiple: false,
                                                        existingUrl: card.imageUrl, // Pass existing URL to prefill
                                                    });
                                                    frame.on('select', () => {
                                                        const attachment = frame.state().get('selection').first().toJSON();
                                                        updateCard(cardIndex, 'imageUrl', attachment.url);
                                                    });
                                                    frame.open();
                                                },
                                            })
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'ps-4' },
                                            wp.element.createElement(
                                                wp.blockEditor.RichText,
                                                {
                                                    tagName: 'h3',
                                                    className: 'fs-lg fw-normal text-body mb-2',
                                                    value: card.planName,
                                                    onChange: (value) => updateCard(cardIndex, 'planName', value),
                                                    placeholder: 'Plan Name',
                                                }
                                            ),
                                            wp.element.createElement(
                                                wp.blockEditor.RichText,
                                                {
                                                    tagName: 'h4',
                                                    className: 'h3 lh-1 mb-0',
                                                    value: card.price,
                                                    onChange: (value) => updateCard(cardIndex, 'price', value),
                                                    placeholder: 'Price',
                                                }
                                            ),
                                            wp.element.createElement(
                                                wp.blockEditor.RichText,
                                                {
                                                    tagName: 'span',
                                                    className: 'text-body fs-sm fw-normal',
                                                    value: card.pricePeriod,
                                                    onChange: (value) => updateCard(cardIndex, 'pricePeriod', value),
                                                    placeholder: 'Price Period',
                                                }
                                            )
                                        )
                                    ),
                                    wp.element.createElement(
                                        'ul',
                                        { className: 'list-unstyled fs-sm pb-md-3 mb-3' },
                                        card.features.map((feature, featureIndex) => (
                                            wp.element.createElement(
                                                'li',
                                                { key: featureIndex, className: 'd-flex mb-2' },
                                                wp.element.createElement(
                                                    'select',
                                                    {
                                                        value: feature.type,
                                                        onChange: (e) => updateFeature(cardIndex, featureIndex, 'type', e.target.value),
                                                    },
                                                    wp.element.createElement('option', { value: 'included' }, 'Included'),
                                                    wp.element.createElement('option', { value: 'excluded' }, 'Excluded')
                                                ),
                                                wp.element.createElement(
                                                    wp.blockEditor.RichText,
                                                    {
                                                        tagName: 'span',
                                                        value: feature.text,
                                                        onChange: (value) => updateFeature(cardIndex, featureIndex, 'text', value),
                                                        placeholder: 'Feature text',
                                                    }
                                                ),
                                                wp.element.createElement(
                                                    wp.components.Button,
                                                    {
                                                        isDestructive: true,
                                                        onClick: () => removeFeature(cardIndex, featureIndex),
                                                    },
                                                    'Remove'
                                                )
                                            )
                                        )),
                                        wp.element.createElement(
                                            wp.components.Button,
                                            {
                                                isSecondary: true,
                                                onClick: () => addFeature(cardIndex),
                                                disabled: card.features.length >= 10,
                                            },
                                            '+ Add Feature'
                                        )
                                    )
                                ),
                                wp.element.createElement(
                                    'div',
                                    { className: 'card-footer border-0 pt-0 pb-4' },
                                    wp.element.createElement(
                                        wp.blockEditor.RichText,
                                        {
                                            tagName: 'a',
                                            className: 'btn btn-outline-primary w-100',
                                            value: card.buttonText,
                                            onChange: (value) => updateCard(cardIndex, 'buttonText', value),
                                            placeholder: 'Button Text',
                                            href: card.buttonUrl,
                                        }
                                    ),
                                    wp.element.createElement(
                                        wp.components.TextControl,
                                        {
                                            label: 'Button URL',
                                            value: card.buttonUrl,
                                            onChange: (value) => updateCard(cardIndex, 'buttonUrl', value),
                                        }
                                    )
                                ),
                                wp.element.createElement(
                                    wp.components.Button,
                                    {
                                        isDestructive: true,
                                        onClick: () => removeCard(cardIndex),
                                        disabled: cards.length <= 1,
                                    },
                                    'Remove Card'
                                )
                            )
                        )
                    )),
                    wp.element.createElement(
                        wp.components.Button,
                        {
                            isPrimary: true,
                            onClick: addCard,
                            disabled: cards.length >= 3,
                        },
                        '+ Add Card'
                    )
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { cards } = attributes;

        return wp.element.createElement(
            'div',
            { className: 'table-responsive-lg' },
            wp.element.createElement(
                'div',
                { className: 'row flex-nowrap pb-4' },
                cards.map((card, index) => (
                    wp.element.createElement(
                        'div',
                        { key: index, className: 'col' },
                        wp.element.createElement(
                            'div',
                            { className: 'card h-100 border-0 shadow-sm p-xxl-3' },
                            wp.element.createElement(
                                'div',
                                { className: 'card-body' },
                                wp.element.createElement(
                                    'div',
                                    { className: 'd-flex align-items-center pb-2 pb-md-3 mb-4' },
                                    wp.element.createElement(
                                        'div',
                                        { className: 'flex-shrink-0 bg-secondary rounded-3' },
                                        wp.element.createElement('img', {
                                            src: card.imageUrl,
                                            width: '84',
                                            alt: 'Icon',
                                        })
                                    ),
                                    wp.element.createElement(
                                        'div',
                                        { className: 'ps-4' },
                                        wp.element.createElement(
                                            'h3',
                                            { className: 'fs-lg fw-normal text-body mb-2' },
                                            card.planName
                                        ),
                                        wp.element.createElement(
                                            'h4',
                                            { className: 'h3 lh-1 mb-0' },
                                            card.price,
                                            ' ',
                                            wp.element.createElement(
                                                'span',
                                                { className: 'text-body fs-sm fw-normal' },
                                                card.pricePeriod
                                            )
                                        )
                                    )
                                ),
                                wp.element.createElement(
                                    'ul',
                                    { className: 'list-unstyled fs-sm pb-md-3 mb-3' },
                                    card.features.map((feature, featureIndex) => (
                                        wp.element.createElement(
                                            'li',
                                            {
                                                key: featureIndex,
                                                className: `d-flex mb-2 ${feature.type === 'excluded' ? 'text-muted' : ''}`,
                                            },
                                            feature.type === 'included'
                                                ? wp.element.createElement('i', { className: 'bx bx-check fs-xl text-primary me-1' })
                                                : wp.element.createElement('i', { className: 'bx bx-x fs-xl me-1' }),
                                            feature.text
                                        )
                                    ))
                                )
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'card-footer border-0 pt-0 pb-4' },
                                wp.element.createElement(
                                    'a',
                                    { href: card.buttonUrl, className: 'btn btn-outline-primary w-100' },
                                    card.buttonText
                                )
                            )
                        )
                    )
                ))
            )
        );
    },
});
// uCertify Pricing Block Ends

// uCertify FAQ Accordion Block Starts
wp.blocks.registerBlockType('ucertify/uc-accordion', {
    title: 'uC Accordion',
    icon: 'menu-alt', // Icon for the block
    category: 'ucertify-widgets',
    attributes: {
        variant: {
            type: 'string',
            default: 'default', // Default style variant
        },
        items: {
            type: 'array',
            default: [
                {
                    title: 'Accordion Item #1',
                    content: 'This is the content for the first accordion item. Edit it as needed.',
                    id: 'accordion-item-1', // Unique ID for accessibility
                },
                {
                    title: 'Accordion Item #2',
                    content: 'This is the content for the second accordion item. Add more details here.',
                    id: 'accordion-item-2',
                },
            ],
        },
        activeItem: {
            type: 'number',
            default: 0, // Index of the currently open item in the editor
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { variant, items, activeItem } = attributes;

        // Variant options for the inspector controls
        const variantOptions = [
            { label: 'Default', value: 'default' },
            { label: 'Primary', value: 'primary' },
            { label: 'Success', value: 'success' },
            { label: 'Info', value: 'info' },
            { label: 'Warning', value: 'warning' },
            { label: 'Danger', value: 'danger' },
        ];

        // Function to add a new accordion item
        const addItem = () => {
            const newItem = {
                title: `Accordion Item #${items.length + 1}`,
                content: 'This is the content for a new accordion item.',
                id: `accordion-item-${Date.now()}-${items.length}`,
            };
            setAttributes({ items: [...items, newItem] });
        };

        // Function to remove an accordion item
        const removeItem = (index) => {
            if (items.length > 1) {
                const newItems = items.filter((_, i) => i !== index);
                let newActiveItem = activeItem;
                if (index <= activeItem && newItems.length > 0) {
                    newActiveItem = Math.max(0, activeItem - 1);
                }
                setAttributes({ items: newItems, activeItem: newActiveItem });
            }
        };

        // Function to update item title
        const updateItemTitle = (index, newTitle) => {
            const newItems = [...items];
            newItems[index].title = newTitle;
            setAttributes({ items: newItems });
        };

        // Function to update item content
        const updateItemContent = (index, newContent) => {
            const newItems = [...items];
            newItems[index].content = newContent;
            setAttributes({ items: newItems });
        };

        // Function to toggle active item in the editor
        const toggleItem = (index) => {
            setAttributes({ activeItem: index });
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-accordion-editor' },
            // Inspector Controls for variant selection
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'Accordion Settings' },
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'Style Variant',
                            value: variant,
                            options: variantOptions,
                            onChange: (newVariant) => setAttributes({ variant: newVariant }),
                        }
                    )
                )
            ),
            // Accordion markup
            wp.element.createElement(
                'div',
                { className: `accordion ${variant !== 'default' ? `accordion-${variant}` : ''}` },
                items.map((item, index) =>
                    wp.element.createElement(
                        'div',
                        { key: index, className: 'accordion-item' },
                        wp.element.createElement(
                            'h2',
                            { className: 'accordion-header' },
                            wp.element.createElement(
                                'button',
                                {
                                    className: `accordion-button ${index === activeItem ? '' : 'collapsed'}`,
                                    type: 'button',
                                    onClick: () => toggleItem(index),
                                    style: { cursor: 'pointer' },
                                },
                                wp.element.createElement(
                                    wp.blockEditor.RichText,
                                    {
                                        tagName: 'span',
                                        value: item.title,
                                        onChange: (newTitle) => updateItemTitle(index, newTitle),
                                        placeholder: 'Accordion title...',
                                    }
                                ),
                                wp.element.createElement(
                                    wp.components.Button,
                                    {
                                        isDestructive: true,
                                        onClick: () => removeItem(index),
                                        disabled: items.length <= 1,
                                        style: { marginLeft: '10px' },
                                    },
                                    'Remove'
                                )
                            )
                        ),
                        wp.element.createElement(
                            'div',
                            {
                                className: `accordion-collapse collapse ${index === activeItem ? 'show' : ''}`,
                            },
                            wp.element.createElement(
                                'div',
                                { className: 'accordion-body' },
                                wp.element.createElement(
                                    wp.blockEditor.RichText,
                                    {
                                        tagName: 'p',
                                        value: item.content,
                                        onChange: (newContent) => updateItemContent(index, newContent),
                                        placeholder: 'Accordion content...',
                                    }
                                )
                            )
                        )
                    )
                ),
                wp.element.createElement(
                    wp.components.Button,
                    {
                        isPrimary: true,
                        onClick: addItem,
                    },
                    '+ Add Accordion Item'
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { variant, items } = attributes;

        return wp.element.createElement(
            'div',
            { className: `accordion ${variant !== 'default' ? `accordion-${variant}` : ''}` },
            items.map((item, index) =>
                wp.element.createElement(
                    'div',
                    { key: index, className: 'accordion-item' },
                    wp.element.createElement(
                        'h2',
                        { className: 'accordion-header', id: `heading-${item.id}` },
                        wp.element.createElement(
                            'button',
                            {
                                className: `accordion-button ${index === 0 ? '' : 'collapsed'}`,
                                type: 'button',
                                'data-bs-toggle': 'collapse',
                                'data-bs-target': `#collapse-${item.id}`,
                                'aria-expanded': index === 0 ? 'true' : 'false',
                                'aria-controls': `collapse-${item.id}`,
                            },
                            item.title
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        {
                            id: `collapse-${item.id}`,
                            className: `accordion-collapse collapse ${index === 0 ? 'show' : ''}`,
                            'aria-labelledby': `heading-${item.id}`,
                            'data-bs-parent': `#accordion-${items[0].id}`,
                        },
                        wp.element.createElement(
                            'div',
                            { className: 'accordion-body' },
                            wp.element.createElement('p', null, item.content)
                        )
                    )
                )
            )
        );
    },
});
// uCertify FAQ Accordion Block Ends

// uCertify Tabs With Images Block Starts
wp.blocks.registerBlockType('ucertify/uc-tabs-with-images', {
    title: 'uC Tabs with Images',
    icon: 'editor-ul',
    category: 'ucertify-widgets',
    attributes: {
        mainHeading: {
            type: 'string',
            default: 'Industries We Serve',
        },
        tabs: {
            type: 'array',
            default: [
                {
                    title: 'Education',
                    heading: 'Education',
                    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    imageUrl: ucBlockData.themeUrl + '/assets/img/image-placeholder-2.webp',
                },
                {
                    title: 'E-Commerce',
                    heading: 'E-Commerce',
                    content: 'Vestibulum nunc lectus auctor quis. Natoque lectus tortor lacus, eu.',
                    imageUrl: ucBlockData.themeUrl + '/assets/img/image-placeholder-2.webp',
                },
            ],
        },
        activeTab: {
            type: 'number',
            default: 0, // Index of the active tab
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { mainHeading, tabs, activeTab } = attributes;

        // Function to add a new tab (max 5)
        const addTab = () => {
            if (tabs.length < 5) {
                const newTab = {
                    title: 'New Tab',
                    heading: 'New Heading',
                    content: 'Lorem ipsum dolor sit amet.',
                    imageUrl: ucBlockData.themeUrl + '/assets/img/image-placeholder-2.webp',
                };
                setAttributes({ tabs: [...tabs, newTab] });
            }
        };

        // Function to remove a tab
        const removeTab = (index) => {
            if (tabs.length > 1) {
                const newTabs = tabs.filter((_, i) => i !== index);
                let newActiveTab = activeTab;
                if (index === activeTab && newTabs.length > 0) {
                    newActiveTab = Math.max(0, activeTab - 1);
                }
                setAttributes({ tabs: newTabs, activeTab: newActiveTab });
            }
        };

        // Function to update tab details
        const updateTab = (index, field, value) => {
            const newTabs = [...tabs];
            newTabs[index][field] = value;
            setAttributes({ tabs: newTabs });
        };

        // Function to switch active tab
        const switchTab = (index) => {
            setAttributes({ activeTab: index });
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-tabs-with-images-editor' },
            // Main Heading
            wp.element.createElement(wp.blockEditor.RichText, {
                tagName: 'h2',
                className: 'h1 text-left pb-3 pb-lg-4',
                value: mainHeading,
                onChange: (value) => setAttributes({ mainHeading: value }),
                placeholder: 'Enter main heading...',
            }),
            // Tab Navigation
            wp.element.createElement(
                'ul',
                { className: 'nav nav-tabs flex-nowrap justify-content-lg-center overflow-auto pb-2 mb-3 mb-lg-4' },
                tabs.map((tab, index) => (
                    wp.element.createElement(
                        'li',
                        { key: index, className: 'nav-item' },
                        wp.element.createElement(
                            'div',
                            {
                                className: `nav-link text-nowrap ${index === activeTab ? 'active' : ''}`,
                                onClick: () => switchTab(index),
                                style: { cursor: 'pointer' },
                            },
                            wp.element.createElement(wp.blockEditor.RichText, {
                                tagName: 'span',
                                value: tab.title,
                                onChange: (value) => updateTab(index, 'title', value),
                                placeholder: 'Tab title...',
                            }),
                            wp.element.createElement(wp.components.Button, {
                                isDestructive: true,
                                onClick: (e) => {
                                    e.stopPropagation();
                                    removeTab(index);
                                },
                            }, '×')
                        )
                    )
                )),
                wp.element.createElement(
                    'li',
                    { className: 'nav-item' },
                    wp.element.createElement(wp.components.Button, {
                        isPrimary: true,
                        onClick: addTab,
                        disabled: tabs.length >= 5,
                    }, '+ Add Tab')
                )
            ),
            // Active Tab Content
            wp.element.createElement(
                'div',
                { className: 'tab-content-editor' },
                wp.element.createElement(
                    'div',
                    { className: 'row align-items-center pt-3 pt-sm-4 pt-md-0 px-3 px-sm-4 px-lg-0' },
                    wp.element.createElement(
                        'div',
                        { className: 'col-lg-4 col-md-5 offset-lg-1 text-center text-md-start' },
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'h3',
                            className: 'mb-lg-4',
                            value: tabs[activeTab].heading,
                            onChange: (value) => updateTab(activeTab, 'heading', value),
                            placeholder: 'Enter tab heading...',
                        }),
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'p',
                            value: tabs[activeTab].content,
                            onChange: (value) => updateTab(activeTab, 'content', value),
                            placeholder: 'Enter tab content...',
                        })
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'col-lg-6 col-md-7 mt-2 mb-3 mt-md-3' },
                        wp.element.createElement('img', {
                            src: tabs[activeTab].imageUrl,
                            className: 'd-block rounded-3 my-lg-2 mx-auto me-md-0',
                            width: '564',
                            alt: 'Image',
                            onClick: () => {
                                const frame = wp.media({
                                    title: 'Select or Upload Image',
                                    button: { text: 'Use this image' },
                                    multiple: false,
                                    existingUrl: tabs[activeTab].imageUrl, // Pass existing URL
                                });
                                frame.on('select', () => {
                                    const attachment = frame.state().get('selection').first().toJSON();
                                    updateTab(activeTab, 'imageUrl', attachment.url);
                                });
                                frame.open();
                            },
                        })
                    )
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { mainHeading, tabs } = attributes;

        return wp.element.createElement(
            'div',
            { className: 'container py-2 mb-2' },
            wp.element.createElement(
                'h2',
                { className: 'h1 text-left pb-3 pb-lg-4' },
                mainHeading
            ),
            wp.element.createElement(
                'ul',
                { className: 'nav nav-tabs flex-nowrap justify-content-lg-center overflow-auto pb-2 mb-3 mb-lg-4', role: 'tablist' },
                tabs.map((tab, index) => (
                    wp.element.createElement(
                        'li',
                        { key: index, className: 'nav-item', role: 'presentation' },
                        wp.element.createElement(
                            'button',
                            {
                                className: `nav-link text-nowrap ${index === 0 ? 'active' : ''}`,
                                id: `${tab.title.toLowerCase().replace(/\s/g, '-')}-tab`,
                                'data-bs-toggle': 'tab',
                                'data-bs-target': `#${tab.title.toLowerCase().replace(/\s/g, '-')}`,
                                type: 'button',
                                role: 'tab',
                                'aria-controls': tab.title.toLowerCase().replace(/\s/g, '-'),
                                'aria-selected': index === 0 ? 'true' : 'false',
                            },
                            tab.title
                        )
                    )
                ))
            ),
            wp.element.createElement(
                'div',
                { className: 'tab-content bg-faded-primary rounded-3 py-4' },
                tabs.map((tab, index) => (
                    wp.element.createElement(
                        'div',
                        {
                            key: index,
                            className: `tab-pane fade ${index === 0 ? 'show active' : ''}`,
                            id: tab.title.toLowerCase().replace(/\s/g, '-'),
                            role: 'tabpanel',
                            'aria-labelledby': `${tab.title.toLowerCase().replace(/\s/g, '-')}-tab`,
                        },
                        wp.element.createElement(
                            'div',
                            { className: 'row align-items-center pt-3 pt-sm-4 pt-md-0 px-3 px-sm-4 px-lg-0' },
                            wp.element.createElement(
                                'div',
                                { className: 'col-lg-4 col-md-5 offset-lg-1 text-center text-md-start' },
                                wp.element.createElement(
                                    'h3',
                                    { className: 'mb-lg-4' },
                                    tab.heading
                                ),
                                wp.element.createElement(
                                    'p',
                                    null,
                                    tab.content
                                )
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'col-lg-6 col-md-7 mt-2 mb-3 mt-md-3' },
                                wp.element.createElement('img', {
                                    src: tab.imageUrl,
                                    className: 'd-block rounded-3 my-lg-2 mx-auto me-md-0',
                                    width: '564',
                                    alt: 'Image',
                                })
                            )
                        )
                    )
                ))
            )
        );
    },
});
// uCertify Tabs With Images Block Ends

// uCertify Myths Starts
// wp.blocks.registerBlockType('ucertify/uc-myth-block', {
//     title: 'uC Myth Block',
//     icon: 'list-ul',
//     category: 'ucertify-widgets',
//     attributes: {
//         heading: {
//             type: 'string',
//             default: 'Common Myths About CompTIA Certifications – Debunked!',
//         },
//         paragraph: {
//             type: 'string',
//             default: 'Preparations are deemed to be difficult & ‘too much’ for the course of a technical nature, but have anyone ever asked, why? Here is a comprehensive list that proves certifications need not be difficult, they can very well be easy & quick for individuals.',
//         },
//         listItems: {
//             type: 'array',
//             default: [
//                 { tag: 'h3', text: 'Myth #1: CompTIA Certification Exams Are Difficult to Pass' },
//                 { tag: 'h3', text: 'Myth #2: CompTIA Certifications are Only for IT Professionals' },
//                 { tag: 'h3', text: 'Myth #3: You Need Years of Experience to Pass' },
//             ],
//         },
//         textAlign: {
//             type: 'string',
//             default: 'center', // Options: 'left', 'center', 'right'
//         },
//     },
//     edit: function(props) {
//         const { attributes, setAttributes } = props;
//         const { heading, paragraph, listItems, textAlign } = attributes;

//         const addListItem = () => {
//             const newItem = { tag: 'h3', text: 'New Myth' };
//             setAttributes({ listItems: [...listItems, newItem] });
//         };

//         const removeListItem = (index) => {
//             const newListItems = listItems.filter((_, i) => i !== index);
//             setAttributes({ listItems: newListItems });
//         };

//         const updateListItem = (index, field, value) => {
//             const newListItems = [...listItems];
//             newListItems[index][field] = value;
//             setAttributes({ listItems: newListItems });
//         };

//         return wp.element.createElement(
//             'div',
//             { className: 'uc-myth-block-editor' },
//             wp.element.createElement(wp.blockEditor.InspectorControls, null,
//                 wp.element.createElement(wp.components.PanelBody, { title: 'Block Settings' },
//                     wp.element.createElement(wp.components.SelectControl, {
//                         label: 'Text Alignment',
//                         value: textAlign,
//                         options: [
//                             { label: 'Left', value: 'left' },
//                             { label: 'Center', value: 'center' },
//                             { label: 'Right', value: 'right' },
//                         ],
//                         onChange: (value) => setAttributes({ textAlign: value }),
//                     })
//                 )
//             ),
//             wp.element.createElement(wp.blockEditor.RichText, {
//                 tagName: 'h2',
//                 className: `h3 fw-bold mb-3 text-${textAlign}`,
//                 value: heading,
//                 onChange: (value) => setAttributes({ heading: value }),
//                 placeholder: 'Enter heading...',
//             }),
//             wp.element.createElement(wp.blockEditor.RichText, {
//                 tagName: 'p',
//                 className: `mb-4 text-${textAlign}`,
//                 value: paragraph,
//                 onChange: (value) => setAttributes({ paragraph: value }),
//                 placeholder: 'Enter paragraph...',
//             }),
//             listItems.map((item, index) => (
//                 wp.element.createElement(
//                     'div',
//                     { key: index, className: 'list-item-editor mb-3 d-flex align-items-start' },
//                     wp.element.createElement('i', {
//                         className: `bx bx-circle me-2`,
//                         style: {
//                             fontSize: item.tag === 'h2' ? '1.5rem' : item.tag === 'h6' ? '0.75rem' : '1rem',
//                         },
//                     }),
//                     wp.element.createElement(
//                         'select',
//                         {
//                             value: item.tag,
//                             onChange: (e) => updateListItem(index, 'tag', e.target.value),
//                             className: 'me-2',
//                         },
//                         ['h2', 'h3', 'h4', 'h5', 'h6'].map((tag) => (
//                             wp.element.createElement('option', { key: tag, value: tag }, tag.toUpperCase())
//                         ))
//                     ),
//                     wp.element.createElement(wp.blockEditor.RichText, {
//                         tagName: 'span',
//                         value: item.text,
//                         onChange: (value) => updateListItem(index, 'text', value),
//                         placeholder: 'Enter myth...',
//                         className: 'flex-grow-1',
//                     }),
//                     wp.element.createElement(wp.components.Button, {
//                         isDestructive: true,
//                         onClick: () => removeListItem(index),
//                     }, 'Remove')
//                 )
//             )),
//             wp.element.createElement(wp.components.Button, {
//                 isPrimary: true,
//                 onClick: addListItem,
//             }, '+ Add Myth')
//         );
//     },
//     save: function(props) {
//         const { attributes } = props;
//         const { heading, paragraph, listItems, textAlign } = attributes;

//         return wp.element.createElement(
//             'div',
//             { className: 'container' },
//             wp.element.createElement(
//                 'h2',
//                 { className: `h3 fw-bold mb-3 text-${textAlign}` },
//                 heading
//             ),
//             wp.element.createElement(
//                 'p',
//                 { className: `mb-4 text-${textAlign}` },
//                 paragraph
//             ),
//             wp.element.createElement(
//                 'ul',
//                 { className: 'list-unstyled' },
//                 listItems.map((item, index) => (
//                     wp.element.createElement(
//                         'li',
//                         { key: index, className: 'd-flex align-items-start mb-3' },
//                         wp.element.createElement('i', {
//                             className: `bx bx-circle me-2`,
//                             style: {
//                                 fontSize: item.tag === 'h2' ? '1.5rem' : item.tag === 'h6' ? '0.75rem' : '1rem',
//                             },
//                         }),
//                         wp.element.createElement(item.tag, { className: 'fw-bold' }, item.text)
//                     )
//                 ))
//             )
//         );
//     },
// });
// uCertify Myths Ends
// uCertify Pros Starts
wp.blocks.registerBlockType('ucertify/uc-pros', {
    title: 'uC Pros',
    icon: 'plus',
    category: 'ucertify-widgets',
    attributes: {
        title: {
            type: 'string',
            default: 'PROS',
        },
        items: {
            type: 'array',
            default: [
                'A eu, ac nunc, volutpat. Augue enim ac justo, at elementum, arcu.',
                'At sodales quam felis ullamcorper iaculis tristique. Felis, etiam felis pellentesque sit neque.',
                'Porta ipsum quis lacus eu ipsum mattis sit quis. Massa, massa lectus porttitor laoreet ultricies odio fermentum arcu quam.',
                'Accumsan arcu neque, nisl, pellentesque fames justo consequat blandit lacus. Eget odio vel nulla vel.',
                'Diam ac phasellus est, eu urna purus blandit aliquam. Vitae accumsan et pellentesque diam in.',
                'Tellus arcu, lectus tincidunt neque nunc. Bibendum lacus, molestie ultrices sed arcu.',
            ],
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { title, items } = attributes;

        const addItem = () => {
            setAttributes({ items: [...items, 'New item...'] });
        };

        const removeItem = (index) => {
            const newItems = items.filter((_, i) => i !== index);
            setAttributes({ items: newItems });
        };

        const updateItem = (index, value) => {
            const newItems = [...items];
            newItems[index] = value;
            setAttributes({ items: newItems });
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-pros-editor' },
            wp.element.createElement(wp.blockEditor.RichText, {
                tagName: 'h4',
                className: 'h6 mb-2',
                value: title,
                onChange: (value) => setAttributes({ title: value }),
                placeholder: 'Enter title...',
            }, wp.element.createElement('i', { className: 'bx bx-plus-circle me-1 mt-n1 align-middle fs-5 text-primary' })),
            wp.element.createElement(
                'ul',
                { className: 'mb-4 pb-2 ps-4' },
                items.map((item, index) => (
                    wp.element.createElement(
                        'li',
                        { key: index, className: 'mb-1' },
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'span',
                            value: item,
                            onChange: (value) => updateItem(index, value),
                            placeholder: 'Enter item...',
                        }),
                        wp.element.createElement(wp.components.Button, {
                            isDestructive: true,
                            onClick: () => removeItem(index),
                            style: { marginLeft: '10px' },
                        }, 'Remove')
                    )
                ))
            ),
            wp.element.createElement(wp.components.Button, {
                isPrimary: true,
                onClick: addItem,
            }, '+ Add Item')
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { title, items } = attributes;

        return wp.element.createElement(
            'div',
            null,
            wp.element.createElement(
                'h4',
                { className: 'h6 mb-2' },
                wp.element.createElement('i', { className: 'bx bx-plus-circle me-1 mt-n1 align-middle fs-5 text-primary' }),
                title
            ),
            wp.element.createElement(
                'ul',
                { className: 'mb-4 pb-2 ps-4' },
                items.map((item, index) => (
                    wp.element.createElement('li', { key: index, className: 'mb-1' }, item)
                ))
            )
        );
    },
});
// uCertify Pros Ends

// uCertify Cons Starts
wp.blocks.registerBlockType('ucertify/uc-cons', {
    title: 'uC Cons',
    icon: 'minus',
    category: 'ucertify-widgets',
    attributes: {
        title: {
            type: 'string',
            default: 'CONS',
        },
        items: {
            type: 'array',
            default: [
                'Donec maecenas justo, et tortor quam elementum pharetra velit. Auctor dictum purus sollicitudin et quam vehicula amet lacus, integer.',
                'Mi elit nibh erat facilisis. Volutpat eget malesuada mi in.',
                'Tincidunt iaculis eleifend arcu egestas. Sit gravida vestibulum quam scelerisque.',
                'Ornare elit, vel, ullamcorper nunc nulla pellentesque ut varius. Vitae tortor nulla a turpis erat fermentum, rhoncus.',
                'Gravida cursus nunc habitant aliquet lacus. Tempus, interdum nullam non quam ipsum ultricies ac.',
            ],
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { title, items } = attributes;

        const addItem = () => {
            setAttributes({ items: [...items, 'New item...'] });
        };

        const removeItem = (index) => {
            const newItems = items.filter((_, i) => i !== index);
            setAttributes({ items: newItems });
        };

        const updateItem = (index, value) => {
            const newItems = [...items];
            newItems[index] = value;
            setAttributes({ items: newItems });
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-cons-editor' },
            wp.element.createElement(wp.blockEditor.RichText, {
                tagName: 'h4',
                className: 'h6 mb-2',
                value: title,
                onChange: (value) => setAttributes({ title: value }),
                placeholder: 'Enter title...',
            }, wp.element.createElement('i', { className: 'bx bx-minus-circle me-1 mt-n1 align-middle fs-5 text-primary' })),
            wp.element.createElement(
                'ul',
                { className: 'mb-4 pb-2 ps-4' },
                items.map((item, index) => (
                    wp.element.createElement(
                        'li',
                        { key: index, className: 'mb-1' },
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'span',
                            value: item,
                            onChange: (value) => updateItem(index, value),
                            placeholder: 'Enter item...',
                        }),
                        wp.element.createElement(wp.components.Button, {
                            isDestructive: true,
                            onClick: () => removeItem(index),
                            style: { marginLeft: '10px' },
                        }, 'Remove')
                    )
                ))
            ),
            wp.element.createElement(wp.components.Button, {
                isPrimary: true,
                onClick: addItem,
            }, '+ Add Item')
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { title, items } = attributes;

        return wp.element.createElement(
            'div',
            null,
            wp.element.createElement(
                'h4',
                { className: 'h6 mb-2' },
                wp.element.createElement('i', { className: 'bx bx-minus-circle me-1 mt-n1 align-middle fs-5 text-primary' }),
                title
            ),
            wp.element.createElement(
                'ul',
                { className: 'mb-4 pb-2 ps-4' },
                items.map((item, index) => (
                    wp.element.createElement('li', { key: index, className: 'mb-1' }, item)
                ))
            )
        );
    },
});
// uCertify Cons Ends

// uCertify CEO / XFO Quote Starts
wp.blocks.registerBlockType('ucertify/uc-ceo', {
    title: 'uC CEO',
    icon: 'businessman',
    category: 'ucertify-widgets',
    attributes: {
        quote: {
            type: 'string',
            default: 'Sollicitudin eget massa, elementum, purus nec fermentum vitae, elementum. Tincidunt vulputate lorem cursus id. Dictum tincidunt mi ornare tristique. Id sit elit pulvinar eu. Tempus vel, mauris sed proin aliquet vulputate cras est. Ut ornare eget a viverra.',
        },
        name: {
            type: 'string',
            default: 'Jane Cooper',
        },
        title: {
            type: 'string',
            default: 'CEO of Ipsum Company',
        },
        imageUrl: {
            type: 'string',
            default: ucBlockData.themeUrl + '/assets/img/image-placeholder.webp',
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { quote, name, title, imageUrl } = attributes;

        const updateImage = () => {
            const frame = wp.media({
                title: 'Select or Upload Image',
                button: { text: 'Use this image' },
                multiple: false,
                library: { type: 'image' },
            });
            frame.on('select', () => {
                const attachment = frame.state().get('selection').first().toJSON();
                setAttributes({ imageUrl: attachment.url });
            });
            frame.open();
        };

        return wp.element.createElement(
            'div',
            { className: 'uc-ceo-editor' },
            wp.element.createElement(
                'figure',
                { className: 'position-relative mb-4 ps-4' },
                wp.element.createElement('span', { className: 'position-absolute top-0 start-0 w-3 h-100 bg-primary' }),
                wp.element.createElement(
                    'blockquote',
                    { className: 'blockquote fs-xl fw-medium text-dark ps-1 ps-sm-3' },
                    wp.element.createElement(wp.blockEditor.RichText, {
                        tagName: 'p',
                        value: quote,
                        onChange: (value) => setAttributes({ quote: value }),
                        placeholder: 'Enter quote here...',
                    })
                ),
                wp.element.createElement(
                    'figcaption',
                    { className: 'd-flex align-items-center pt-3 ps-1 ps-sm-3' },
                    wp.element.createElement('img', {
                        src: imageUrl,
                        width: '48',
                        className: 'rounded-circle uc-ceo-cto-dp',
                        alt: name || 'CEO Image',
                        onClick: updateImage,
                        style: { cursor: 'pointer' },
                    }),
                    wp.element.createElement(
                        'div',
                        { className: 'ps-3' },
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'h6',
                            className: 'fw-semibold lh-base mb-0',
                            value: name,
                            onChange: (value) => setAttributes({ name: value }),
                            placeholder: 'Enter name...',
                        }),
                        wp.element.createElement(wp.blockEditor.RichText, {
                            tagName: 'span',
                            className: 'fs-sm text-muted',
                            value: title,
                            onChange: (value) => setAttributes({ title: value }),
                            placeholder: 'Enter title...',
                        })
                    )
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { quote, name, title, imageUrl } = attributes;

        return wp.element.createElement(
            'figure',
            { className: 'position-relative mb-4 ps-4' },
            wp.element.createElement('span', { className: 'position-absolute top-0 start-0 w-3 h-100 bg-primary' }),
            wp.element.createElement(
                'blockquote',
                { className: 'blockquote fs-xl fw-medium text-dark ps-1 ps-sm-3' },
                wp.element.createElement('p', null, quote)
            ),
            wp.element.createElement(
                'figcaption',
                { className: 'd-flex align-items-center pt-3 ps-1 ps-sm-3' },
                wp.element.createElement('img', {
                    src: imageUrl,
                    width: '48',
                    className: 'rounded-circle uc-ceo-cto-dp', // Added custom class
                    alt: name || 'CEO Image',
                }),
                wp.element.createElement(
                    'div',
                    { className: 'ps-3' },
                    wp.element.createElement('h6', { className: 'fw-semibold lh-base mb-0' }, name),
                    wp.element.createElement('span', { className: 'fs-sm text-muted' }, title)
                )
            )
        );
    },
});
// uCertify CEO / XFO Quote Ends

//uC Swiper Section Starts
wp.blocks.registerBlockType('ucertify/uc-swiper-section', {
    title: 'uC Swiper Section',
    icon: 'slides',
    category: 'ucertify-widgets',
    attributes: {
        mainHeading: {
            type: 'string',
            default: 'Industry Trends',
        },
        description: {
            type: 'string',
            default: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.',
        },
        backgroundVariant: {
            type: 'string',
            default: 'bg-secondary',
        },
        articles: {
            type: 'array',
            default: [
                {
                    imageUrl: ucBlockData.themeUrl + '/assets/img/uCertify-placeholder-1.webp',
                    title: 'Lorem Ipsum',
                    description: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    stars: 4.0, // Float for .5 increments
                    buttonUrl: '#',
                },
            ],
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { mainHeading, description, backgroundVariant, articles } = attributes;

        const addArticle = () => {
            if (articles.length < 10) {
                const newArticle = {
                    imageUrl: ucBlockData.themeUrl + '/assets/img/uCertify-placeholder-1.webp',
                    title: 'New Article',
                    description: 'Description for the new article...',
                    stars: 5.0,
                    buttonUrl: '#',
                };
                setAttributes({ articles: [...articles, newArticle] });
            }
        };

        const removeArticle = (index) => {
            if (articles.length > 1) {
                const newArticles = articles.filter((_, i) => i !== index);
                setAttributes({ articles: newArticles });
            }
        };

        const updateArticle = (index, field, value) => {
            const newArticles = [...articles];
            newArticles[index][field] = field === 'stars' ? parseFloat(value) : value;
            setAttributes({ articles: newArticles });
        };

        const variantOptions = [
            { label: 'Secondary', value: 'bg-secondary' },
            { label: 'Faded Primary', value: 'bg-faded-primary' },
            { label: 'Faded Success', value: 'bg-faded-success' },
            { label: 'Faded Warning', value: 'bg-faded-warning' },
            { label: 'Faded Danger', value: 'bg-faded-danger' },
            { label: 'Faded Info', value: 'bg-faded-info' },
            { label: 'Faded Dark', value: 'bg-faded-dark' },
        ];

        const starOptions = [
            0.5, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 4.5, 5.0
        ].map(num => ({ label: `${num} Stars`, value: num }));

        const uniqueId = `swiper-${Date.now()}`;

        return wp.element.createElement(
            'div',
            { className: 'uc-swiper-section-editor' },
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'Swiper Section Settings' },
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'Background Variant',
                            value: backgroundVariant,
                            options: variantOptions,
                            onChange: (newVariant) => setAttributes({ backgroundVariant: newVariant }),
                        }
                    )
                )
            ),
            wp.element.createElement(
                'section',
                { className: backgroundVariant },
                wp.element.createElement(
                    'div',
                    { className: 'container pt-5 pb-lg-5' },
                    wp.element.createElement(
                        'div',
                        { className: 'mb-4' },
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'h2',
                                className: 'my-0',
                                value: mainHeading,
                                onChange: (value) => setAttributes({ mainHeading: value }),
                                placeholder: 'Enter section heading...',
                            }
                        ),
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'p',
                                className: 'mb-3',
                                value: description,
                                onChange: (value) => setAttributes({ description: value }),
                                placeholder: 'Enter section description...',
                            }
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'position-relative' },
                        wp.element.createElement(
                            'div',
                            {
                                className: 'swiper industry-trends-swiper',
                                'data-swiper-options': JSON.stringify({
                                    spaceBetween: 20,
                                    loop: true,
                                    pagination: { el: `#${uniqueId}-pagination`, clickable: true },
                                    navigation: { prevEl: `.${uniqueId}-prev`, nextEl: `.${uniqueId}-next` },
                                    breakpoints: {
                                        500: { slidesPerView: 2 },
                                        768: { slidesPerView: 2 },
                                        1000: { slidesPerView: 3 },
                                    },
                                }),
                            },
                            wp.element.createElement(
                                'div',
                                { className: 'swiper-wrapper' },
                                articles.map((article, index) => (
                                    wp.element.createElement(
                                        'article',
                                        { key: index, className: 'swiper-slide h-auto pb-3' },
                                        wp.element.createElement(
                                            'div',
                                            { className: 'd-block position-relative rounded-3 mb-3' },
                                            wp.element.createElement('a', {
                                                href: article.buttonUrl,
                                                className: 'position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3',
                                                'aria-label': 'Listen podcast',
                                            }),
                                            wp.element.createElement('img', {
                                                src: article.imageUrl,
                                                loading: 'lazy',
                                                className: 'rounded-3',
                                                alt: 'Image',
                                            })
                                        ),
                                        wp.element.createElement(
                                            wp.components.Button,
                                            {
                                                isSecondary: true,
                                                onClick: () => {
                                                    const frame = wp.media({
                                                        title: 'Select or Upload Image',
                                                        button: { text: 'Use this image' },
                                                        multiple: false,
                                                    });
                                                    frame.on('select', () => {
                                                        const attachment = frame.state().get('selection').first().toJSON();
                                                        updateArticle(index, 'imageUrl', attachment.url);
                                                    });
                                                    frame.open();
                                                },
                                                style: { marginBottom: '10px' },
                                            },
                                            'Change Image'
                                        ),
                                        wp.element.createElement(
                                            'h3',
                                            { className: 'h6 uc-blog-heading-2' },
                                            wp.element.createElement(
                                                wp.blockEditor.RichText,
                                                {
                                                    tagName: 'a',
                                                    value: article.title,
                                                    onChange: (value) => updateArticle(index, 'title', value),
                                                    placeholder: 'Enter article title...',
                                                }
                                            )
                                        ),
                                        wp.element.createElement(
                                            wp.blockEditor.RichText,
                                            {
                                                tagName: 'p',
                                                className: 'mb-3 uc-blog-card-description-1',
                                                value: article.description,
                                                onChange: (value) => updateArticle(index, 'description', value),
                                                placeholder: 'Enter article description...',
                                            }
                                        ),
                                        wp.element.createElement('hr', { className: 'mb-3' }),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'd-flex align-items-center' },
                                            wp.element.createElement(
                                                'div',
                                                { className: 'w-50 d-flex align-items-center' },
                                                Array.from({ length: 5 }).map((_, i) => {
                                                    const starValue = i + 1;
                                                    let starClass = 'bx-star text-muted';
                                                    if (starValue <= Math.floor(article.stars)) {
                                                        starClass = 'bxs-star text-warning';
                                                    } else if (starValue - 0.5 <= article.stars) {
                                                        starClass = 'bxs-star-half text-warning';
                                                    }
                                                    return wp.element.createElement('i', {
                                                        key: i,
                                                        className: `bx ${starClass}`,
                                                    });
                                                })
                                            ),
                                            wp.element.createElement(
                                                'div',
                                                { className: 'w-50 text-end' },
                                                wp.element.createElement(
                                                    'a',
                                                    { href: article.buttonUrl, className: 'btn btn-sm btn-outline-primary uc-read-more-1' },
                                                    'Learn More ',
                                                    wp.element.createElement('i', { className: 'bx bx-right-arrow-alt fs-lg ms-1 mt-1' })
                                                )
                                            )
                                        ),
                                        wp.element.createElement(
                                            wp.blockEditor.InspectorControls,
                                            null,
                                            wp.element.createElement(
                                                wp.components.PanelBody,
                                                { title: `Article ${index + 1} Settings` },
                                                wp.element.createElement(
                                                    wp.components.SelectControl,
                                                    {
                                                        label: 'Star Rating',
                                                        value: article.stars,
                                                        options: starOptions,
                                                        onChange: (value) => updateArticle(index, 'stars', parseFloat(value)),
                                                    }
                                                ),
                                                wp.element.createElement(
                                                    wp.components.TextControl,
                                                    {
                                                        label: 'Button URL',
                                                        value: article.buttonUrl,
                                                        onChange: (value) => updateArticle(index, 'buttonUrl', value),
                                                        placeholder: 'Enter URL here...',
                                                    }
                                                )
                                            )
                                        ),
                                        wp.element.createElement(
                                            wp.components.Button,
                                            {
                                                isDestructive: true,
                                                onClick: () => removeArticle(index),
                                                disabled: articles.length <= 1,
                                            },
                                            'Remove Article'
                                        )
                                    )
                                ))
                            )
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'd-flex justify-content-between align-items-center mb-3' },
                            wp.element.createElement('div', {
                                className: 'swiper-pagination justify-content-start position-relative pt-3 mt-4',
                                id: `${uniqueId}-pagination`,
                            }),
                            wp.element.createElement(
                                'div',
                                { className: 'd-flex' },
                                wp.element.createElement('button', {
                                    type: 'button',
                                    className: `btn btn-prev ${uniqueId}-prev btn-icon btn-sm`,
                                }, wp.element.createElement('i', { className: 'bx bx-chevron-left' })),
                                wp.element.createElement('button', {
                                    type: 'button',
                                    className: `btn btn-next ${uniqueId}-next btn-icon btn-sm ms-2`,
                                }, wp.element.createElement('i', { className: 'bx bx-chevron-right' }))
                            )
                        )
                    ),
                    wp.element.createElement(
                        wp.components.Button,
                        {
                            isPrimary: true,
                            onClick: addArticle,
                            disabled: articles.length >= 10,
                        },
                        '+ Add Article'
                    )
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { mainHeading, description, backgroundVariant, articles } = attributes;
        const uniqueId = `swiper-${Date.now()}`;

        return wp.element.createElement(
            'section',
            { className: backgroundVariant },
            wp.element.createElement(
                'div',
                { className: 'container pt-5 pb-lg-5' },
                wp.element.createElement(
                    'div',
                    { className: 'mb-4' },
                    wp.element.createElement('h2', { className: 'my-0' }, mainHeading),
                    wp.element.createElement('p', { className: 'mb-3' }, description)
                ),
                wp.element.createElement(
                    'div',
                    { className: 'position-relative' },
                    wp.element.createElement(
                        'div',
                        {
                            className: 'swiper industry-trends-swiper',
                            'data-swiper-options': JSON.stringify({
                                spaceBetween: 20,
                                loop: true,
                                pagination: { el: `#${uniqueId}-pagination`, clickable: true },
                                navigation: { prevEl: `.${uniqueId}-prev`, nextEl: `.${uniqueId}-next` },
                                breakpoints: {
                                    500: { slidesPerView: 2 },
                                    768: { slidesPerView: 2 },
                                    1000: { slidesPerView: 3 },
                                },
                            }),
                        },
                        wp.element.createElement(
                            'div',
                            { className: 'swiper-wrapper' },
                            articles.map((article, index) => (
                                wp.element.createElement(
                                    'article',
                                    { key: index, className: 'swiper-slide h-auto pb-3' },
                                    wp.element.createElement(
                                        'div',
                                        { className: 'd-block position-relative rounded-3 mb-3' },
                                        wp.element.createElement('a', {
                                            href: article.buttonUrl,
                                            className: 'position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3',
                                            'aria-label': 'Listen podcast',
                                        }),
                                        wp.element.createElement('img', {
                                            src: article.imageUrl,
                                            loading: 'lazy',
                                            className: 'rounded-3',
                                            alt: 'Image',
                                        })
                                    ),
                                    wp.element.createElement(
                                        'h3',
                                        { className: 'h6 uc-blog-heading-2' },
                                        wp.element.createElement('a', { href: article.buttonUrl }, article.title)
                                    ),
                                    wp.element.createElement('p', { className: 'mb-3 uc-blog-card-description-1' }, article.description),
                                    wp.element.createElement('hr', { className: 'mb-3' }),
                                    wp.element.createElement(
                                        'div',
                                        { className: 'd-flex align-items-center' },
                                        wp.element.createElement(
                                            'div',
                                            { className: 'w-50 d-flex align-items-center' },
                                            Array.from({ length: 5 }).map((_, i) => {
                                                const starValue = i + 1;
                                                let starClass = 'bx-star text-muted'; // Blank star
                                                if (starValue <= Math.floor(article.stars)) {
                                                    starClass = 'bxs-star text-warning'; // Full star
                                                } else if (starValue - 0.5 <= article.stars) {
                                                    starClass = 'bxs-star-half text-warning'; // Half star
                                                }
                                                return wp.element.createElement('i', {
                                                    key: i,
                                                    className: `bx ${starClass}`,
                                                });
                                            })
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'w-50 text-end' },
                                            wp.element.createElement(
                                                'a',
                                                { href: article.buttonUrl, className: 'btn btn-sm btn-outline-primary uc-read-more-1' },
                                                'Learn More ',
                                                wp.element.createElement('i', { className: 'bx bx-right-arrow-alt fs-lg ms-1 mt-1' })
                                            )
                                        )
                                    )
                                )
                            ))
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'd-flex justify-content-between align-items-center mb-3' },
                        wp.element.createElement('div', {
                            className: 'swiper-pagination justify-content-start position-relative pt-3 mt-4',
                            id: `${uniqueId}-pagination`,
                        }),
                        wp.element.createElement(
                            'div',
                            { className: 'd-flex' },
                            wp.element.createElement('button', {
                                type: 'button',
                                className: `btn btn-prev ${uniqueId}-prev btn-icon btn-sm`,
                            }, wp.element.createElement('i', { className: 'bx bx-chevron-left' })),
                            wp.element.createElement('button', {
                                type: 'button',
                                className: `btn btn-next ${uniqueId}-next btn-icon btn-sm ms-2`,
                            }, wp.element.createElement('i', { className: 'bx bx-chevron-right' }))
                        )
                    )
                )
            )
        );
    },
});
//uC Swiper Section Ends

//uC Info Cards - 1 Starts
wp.blocks.registerBlockType('ucertify/uc-info-cards-1', {
    title: 'uC Info Cards - 1',
    icon: 'format-aside',
    category: 'ucertify-widgets',
    attributes: {
        mainHeading: {
            type: 'string',
            default: 'Lorem Ipsum Delore',
        },
        description: {
            type: 'string',
            default: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.',
        },
        backgroundVariant: {
            type: 'string',
            default: 'bg-secondary',
        },
        cards: {
            type: 'array',
            default: [
                {
                    imageUrl: ucBlockData.themeUrl + '/assets/img/uCertify-placeholder-1.webp',
                    title: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.',
                    features: [
                        { text: 'Aenean neque tortor, purus faucibus', type: 'included' },
                        { text: 'Nullam augue vitae et volutpat sagittis', type: 'included' },
                        { text: 'Mauris massa penatibus enim elit quam', type: 'excluded' },
                        { text: 'Nec ac sagittis nunc bibendum', type: 'excluded' },
                        { text: 'Odio ut orci volutpat ultricies eleifend', type: 'excluded' },
                    ],
                    buttonUrl: '#',
                },
            ],
        },
    },
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { mainHeading, description, backgroundVariant, cards } = attributes;

        const addCard = () => {
            if (cards.length < 15) {
                const newCard = {
                    imageUrl: ucBlockData.themeUrl + '/assets/img/uCertify-placeholder-1.webp',
                    title: 'New Card Title',
                    features: [
                        { text: 'New feature', type: 'included' },
                    ],
                    buttonUrl: '#',
                };
                setAttributes({ cards: [...cards, newCard] });
            }
        };

        const removeCard = (index) => {
            if (cards.length > 1) {
                const newCards = cards.filter((_, i) => i !== index);
                setAttributes({ cards: newCards });
            }
        };

        const updateCard = (index, field, value) => {
            const newCards = [...cards];
            newCards[index][field] = value;
            setAttributes({ cards: newCards });
        };

        const addFeature = (cardIndex) => {
            const newCards = [...cards];
            if (newCards[cardIndex].features.length < 10) {
                newCards[cardIndex].features = [
                    ...newCards[cardIndex].features,
                    { text: 'New feature', type: 'included' },
                ];
                setAttributes({ cards: newCards });
            }
        };

        const removeFeature = (cardIndex, featureIndex) => {
            const newCards = [...cards];
            newCards[cardIndex].features = newCards[cardIndex].features.filter((_, i) => i !== featureIndex);
            setAttributes({ cards: newCards });
        };

        const updateFeature = (cardIndex, featureIndex, field, value) => {
            const newCards = [...cards];
            newCards[cardIndex].features[featureIndex][field] = value;
            setAttributes({ cards: newCards });
        };

        const variantOptions = [
            { label: 'Secondary', value: 'bg-secondary' },
            { label: 'Faded Primary', value: 'bg-faded-primary' },
            { label: 'Faded Success', value: 'bg-faded-success' },
            { label: 'Faded Warning', value: 'bg-faded-warning' },
            { label: 'Faded Danger', value: 'bg-faded-danger' },
            { label: 'Faded Info', value: 'bg-faded-info' },
            { label: 'Faded Dark', value: 'bg-faded-dark' },
        ];

        return wp.element.createElement(
            'div',
            { className: 'uc-info-cards-1-editor' },
            wp.element.createElement(
                wp.blockEditor.InspectorControls,
                null,
                wp.element.createElement(
                    wp.components.PanelBody,
                    { title: 'Info Cards Settings' },
                    wp.element.createElement(
                        wp.components.SelectControl,
                        {
                            label: 'Background Variant',
                            value: backgroundVariant,
                            options: variantOptions,
                            onChange: (newVariant) => setAttributes({ backgroundVariant: newVariant }),
                        }
                    )
                )
            ),
            wp.element.createElement(
                'section',
                { className: backgroundVariant },
                wp.element.createElement(
                    'div',
                    { className: 'container pt-5 pb-lg-5' },
                    wp.element.createElement(
                        'div',
                        { className: 'mb-4' },
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'h2',
                                className: 'my-0',
                                value: mainHeading,
                                onChange: (value) => setAttributes({ mainHeading: value }),
                                placeholder: 'Enter section heading...',
                            }
                        ),
                        wp.element.createElement(
                            wp.blockEditor.RichText,
                            {
                                tagName: 'p',
                                className: 'mb-3',
                                value: description,
                                onChange: (value) => setAttributes({ description: value }),
                                placeholder: 'Enter section description...',
                            }
                        )
                    ),
                    cards.map((card, cardIndex) => (
                        wp.element.createElement(
                            'article',
                            { key: cardIndex, className: 'card border-0 shadow-sm overflow-hidden mb-4' },
                            wp.element.createElement(
                                'div',
                                { className: 'row g-0' },
                                wp.element.createElement(
                                    'div',
                                    {
                                        className: 'col-sm-4 position-relative bg-secondary bg-position-center bg-repeat-0 bg-size-contain',
                                        style: { backgroundImage: `url(${card.imageUrl})`, minHeight: '15rem' },
                                    },
                                    wp.element.createElement('a', {
                                        href: card.buttonUrl,
                                        className: 'position-absolute top-0 start-0 w-100 h-100',
                                        'aria-label': 'Read more',
                                    })
                                ),
                                wp.element.createElement(
                                    wp.components.Button,
                                    {
                                        isSecondary: true,
                                        onClick: () => {
                                            const frame = wp.media({
                                                title: 'Select or Upload Image',
                                                button: { text: 'Use this image' },
                                                multiple: false,
                                            });
                                            frame.on('select', () => {
                                                const attachment = frame.state().get('selection').first().toJSON();
                                                updateCard(cardIndex, 'imageUrl', attachment.url);
                                            });
                                            frame.open();
                                        },
                                        style: { margin: '10px' },
                                    },
                                    'Change Image'
                                ),
                                wp.element.createElement(
                                    'div',
                                    { className: 'col-sm-8' },
                                    wp.element.createElement(
                                        'div',
                                        { className: 'card-body' },
                                        wp.element.createElement(
                                            'h5',
                                            { className: 'h5 uc-blog-heading-2' },
                                            wp.element.createElement(
                                                wp.blockEditor.RichText,
                                                {
                                                    tagName: 'a',
                                                    value: card.title,
                                                    onChange: (value) => updateCard(cardIndex, 'title', value),
                                                    placeholder: 'Enter card title...',
                                                }
                                            )
                                        ),
                                        wp.element.createElement(
                                            'ul',
                                            { className: 'list-unstyled fs-sm pb-md-3 mb-3' },
                                            card.features.map((feature, featureIndex) => (
                                                wp.element.createElement(
                                                    'li',
                                                    { key: featureIndex, className: `d-flex mb-2 ${feature.type === 'excluded' ? 'text-muted' : ''}` },
                                                    wp.element.createElement(
                                                        'select',
                                                        {
                                                            value: feature.type,
                                                            onChange: (e) => updateFeature(cardIndex, featureIndex, 'type', e.target.value),
                                                        },
                                                        wp.element.createElement('option', { value: 'included' }, 'Included'),
                                                        wp.element.createElement('option', { value: 'excluded' }, 'Excluded')
                                                    ),
                                                    wp.element.createElement(
                                                        wp.blockEditor.RichText,
                                                        {
                                                            tagName: 'span',
                                                            value: feature.text,
                                                            onChange: (value) => updateFeature(cardIndex, featureIndex, 'text', value),
                                                            placeholder: 'Feature text...',
                                                        }
                                                    ),
                                                    wp.element.createElement(
                                                        wp.components.Button,
                                                        {
                                                            isDestructive: true,
                                                            onClick: () => removeFeature(cardIndex, featureIndex),
                                                        },
                                                        'Remove'
                                                    )
                                                )
                                            ))
                                        ),
                                        wp.element.createElement(
                                            wp.components.Button,
                                            {
                                                isSecondary: true,
                                                onClick: () => addFeature(cardIndex),
                                                disabled: card.features.length >= 10,
                                            },
                                            '+ Add Feature'
                                        ),
                                        wp.element.createElement('hr', { className: 'my-4' }),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'd-flex align-items-center justify-content-between' },
                                            wp.element.createElement(
                                                'a',
                                                { href: card.buttonUrl, className: 'btn btn-sm btn-outline-primary uc-read-more-1' },
                                                'Read more ',
                                                wp.element.createElement('i', { className: 'bx bx-right-arrow-alt fs-lg ms-1 mt-1' })
                                            )
                                        ),
                                        wp.element.createElement(
                                            wp.blockEditor.InspectorControls,
                                            null,
                                            wp.element.createElement(
                                                wp.components.PanelBody,
                                                { title: `Card ${cardIndex + 1} Settings` },
                                                wp.element.createElement(
                                                    wp.components.TextControl,
                                                    {
                                                        label: 'Read More URL',
                                                        value: card.buttonUrl,
                                                        onChange: (value) => updateCard(cardIndex, 'buttonUrl', value),
                                                        placeholder: 'Enter URL here...',
                                                    }
                                                )
                                            )
                                        )
                                    )
                                )
                            ),
                            wp.element.createElement(
                                wp.components.Button,
                                {
                                    isDestructive: true,
                                    onClick: () => removeCard(cardIndex),
                                    disabled: cards.length <= 1,
                                },
                                'Remove Card'
                            )
                        )
                    )),
                    wp.element.createElement(
                        wp.components.Button,
                        {
                            isPrimary: true,
                            onClick: addCard,
                            disabled: cards.length >= 15,
                        },
                        '+ Add Card'
                    )
                )
            )
        );
    },
    save: function(props) {
        const { attributes } = props;
        const { mainHeading, description, backgroundVariant, cards } = attributes;

        return wp.element.createElement(
            'section',
            { className: backgroundVariant },
            wp.element.createElement(
                'div',
                { className: 'container pt-5 pb-lg-5' },
                wp.element.createElement(
                    'div',
                    { className: 'mb-4' },
                    wp.element.createElement('h2', { className: 'my-0' }, mainHeading),
                    wp.element.createElement('p', { className: 'mb-3' }, description)
                ),
                cards.map((card, index) => (
                    wp.element.createElement(
                        'article',
                        { key: index, className: 'card border-0 shadow-sm overflow-hidden mb-4' },
                        wp.element.createElement(
                            'div',
                            { className: 'row g-0' },
                            wp.element.createElement(
                                'div',
                                {
                                    className: 'col-sm-4 position-relative bg-secondary bg-position-center bg-repeat-0 bg-size-contain',
                                    style: { backgroundImage: `url(${card.imageUrl})`, minHeight: '15rem' },
                                },
                                wp.element.createElement('a', {
                                    href: card.buttonUrl,
                                    className: 'position-absolute top-0 start-0 w-100 h-100',
                                    'aria-label': 'Read more',
                                })
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'col-sm-8' },
                                wp.element.createElement(
                                    'div',
                                    { className: 'card-body' },
                                    wp.element.createElement(
                                        'h5',
                                        { className: 'h5 uc-blog-heading-2' },
                                        wp.element.createElement('a', { href: card.buttonUrl }, card.title)
                                    ),
                                    wp.element.createElement(
                                        'ul',
                                        { className: 'list-unstyled fs-sm pb-md-3 mb-3' },
                                        card.features.map((feature, featureIndex) => (
                                            wp.element.createElement(
                                                'li',
                                                { key: featureIndex, className: `d-flex mb-2 ${feature.type === 'excluded' ? 'text-muted' : ''}` },
                                                feature.type === 'included'
                                                    ? wp.element.createElement('i', { className: 'bx bx-check fs-xl text-primary me-1' })
                                                    : wp.element.createElement('i', { className: 'bx bx-x fs-xl me-1' }),
                                                feature.text
                                            )
                                        ))
                                    ),
                                    wp.element.createElement('hr', { className: 'my-4' }),
                                    wp.element.createElement(
                                        'div',
                                        { className: 'd-flex align-items-center justify-content-between' },
                                        wp.element.createElement(
                                            'a',
                                            { href: card.buttonUrl, className: 'btn btn-sm btn-outline-primary uc-read-more-1' },
                                            'Read more ',
                                            wp.element.createElement('i', { className: 'bx bx-right-arrow-alt fs-lg ms-1 mt-1' })
                                        )
                                    )
                                )
                            )
                        )
                    )
                ))
            )
        );
    },
});
//uC Info Cards - 1 Ends