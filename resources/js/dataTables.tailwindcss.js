/*! DataTables Tailwind CSS integration
 * Taken from https://github.com/DataTables/DataTablesSrc/blob/master/js/integration/dataTables.tailwindcss.js
 */

import $ from 'jquery';
import moment from 'moment';
import DataTable from 'datatables.net-dt';
import 'datatables.net-buttons-dt';
import 'datatables.net-select-dt';
import 'datatables.net-editor-dt';
import 'datatables.net-datetime';

window.jQuery = window.$ = $
window.moment = moment;
window.DataTable = DataTable;

/*
 * This is a tech preview of Tailwind CSS integration with DataTables.
 */

// Set the defaults for DataTables initialisation
$.extend(true, DataTable.defaults, {
    renderer: 'tailwindcss',
    layout: {
        top: 'buttons',
        topStart: 'search',
        topEnd: 'pageLength',
        bottomStart: 'info',
        bottomEnd: 'paging'
    },
});


// Default class modification
$.extend(true, DataTable.ext.classes, {
    container: "dt-container dt-tailwindcss",
    search: {
        input: "border placeholder-gray-500 ml-2 px-3 py-2 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-blue-500 dark:placeholder-gray-400"
    },
    info: {
        container: "dt-info"
    },
    length: {
        container: "dt-length",
        select: "border py-2 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-blue-500"
    },
    processing: {
        container: "dt-processing"
    },
    paging: {
        active: 'font-semibold bg-gray-100 dark:bg-gray-700/75',
        notActive: 'bg-white dark:bg-gray-800',
        button: 'relative inline-flex justify-center items-center space-x-2 border px-4 py-2 -mr-px leading-6 hover:z-10 focus:z-10 active:z-10 border-gray-200 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:active:border-gray-700',
        first: 'rounded-l-lg',
        last: 'rounded-r-lg',
        enabled: 'text-gray-800 hover:text-gray-900 hover:border-gray-300 hover:shadow-sm focus:ring focus:ring-gray-300 focus:ring-opacity-25 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40',
        notEnabled: 'text-gray-300 dark:text-gray-600'
    },
    table: 'dataTable min-w-full text-sm align-middle whitespace-nowrap',
    thead: {
        row: 'border-b border-gray-100 dark:border-gray-700/50 uppercase',
        cell: 'px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left dark:text-gray-50 dark:bg-gray-700/25'
    },
    tbody: {
        row: 'even:bg-gray-50 dark:even:bg-gray-900/50',
        cell: 'p-3'
    },
    tfoot: {
        row: 'even:bg-gray-50 dark:even:bg-gray-900/50',
        cell: 'p-3 text-left'
    },
});

DataTable.ext.renderer.pagingButton.tailwindcss = function (settings, buttonType, content, active, disabled) {
    let classes = settings.oClasses.paging;
    let btnClasses = [classes.button];

    btnClasses.push(active ? classes.active : classes.notActive);
    btnClasses.push(disabled ? classes.notEnabled : classes.enabled);

    let a = $('<a>', {
        'href': disabled ? null : '#',
        'class': btnClasses.join(' ')
    })
        .html(content);

    return {
        display: a,
        clicker: a
    };
};

DataTable.ext.renderer.pagingContainer.tailwindcss = function (settings, buttonEls) {
    let classes = settings.oClasses.paging;

    buttonEls[0].addClass(classes.first);
    buttonEls[buttonEls.length - 1].addClass(classes.last);

    return $('<div/>').addClass('flex justify-center gap-1 mt-4').append(buttonEls);
};

DataTable.ext.renderer.layout.tailwindcss = function (settings, container, items) {
    let row = $('<div/>', {
        "class": 'space-y-4'
    }).appendTo(container);

    $.each(items, function (key, val) {
        let klass;
        let children = val.contents.length;

        if (val.table) {
            klass = 'w-full overflow-x-auto rounded-lg shadow';
        } else if (key === 'start') {
            klass = 'flex justify-start';
        } else if (key === 'end') {
            klass = 'flex justify-end';
        } else if (key === 'top') {
            klass = 'flex flex-wrap items-center justify-between gap-4';
        } else if (key === 'bottom') {
            klass = 'flex flex-wrap items-center justify-between gap-4';
        } else {
            klass = 'flex justify-end';
        }

        $('<div/>', {
            id: val.id || null,
            "class": klass + (val.className ? ' ' + val.className : '')
        })
            .append(val.contents)
            .appendTo(row);
    });
};

/* Set the defaults for DataTables Buttons classes */
$.extend(true, DataTable.Buttons.defaults, {
    dom: {
        container: {
            className: 'dt-buttons'
        },
        button: {
            className: 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 mb-2'
        },
        collection: {
            tag: '',
            className: 'dt-button-collection',
            button: {
                tag: 'a',
                className: 'dt-button dropdown-item',
                active: 'active',
                disabled: 'disabled'
            }
        },
        buttonLiner: {
            tag: "",
            className: ""
        }
    }
});


/** Editor & TailwindCSS Buttons default classes */
$.extend(true, DataTable.ext.buttons, {
    create: {
        formButtons: {
            className: 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'
        }
    },
    edit: {
        formButtons: {
            className: 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'
        }
    },
    remove: {
        formButtons: {
            className: 'inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'
        }
    }
});


export default DataTable;
