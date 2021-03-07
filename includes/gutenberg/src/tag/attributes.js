export default {
    view: {
        type: 'string',
        default: 'grid'
    },
    orderby: {
        type: 'string',
        default: 'date'
    },
    order: {
        type: 'string',
        default: 'desc'
    },
    listings_per_page: {
        type: 'number',
        default: 6
    },
    show_pagination: {
        type: 'boolean',
        default: false
    },
    header: {
        type: 'boolean',
        default: false
    },
    header_title: {
        type: 'string',
        default: ''
    },
    columns: {
        type: 'number',
        default: 3
    },
    logged_in_user_only: {
        type: 'boolean',
        default: false
    },
    map_height: {
        type: 'number',
        default: 500
    },
    map_zoom_level: {
        type: 'number',
        default: 0
    },
};
