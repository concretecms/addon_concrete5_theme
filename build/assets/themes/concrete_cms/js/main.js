/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

// Import the frontend foundation for themes.
import '@concretecms/bedrock/assets/bedrock/js/frontend';

// Feature support
import '@concretecms/bedrock/assets/account/js/frontend';
import '@concretecms/bedrock/assets/calendar/js/frontend';
import '@concretecms/bedrock/assets/navigation/js/frontend';
import '@concretecms/bedrock/assets/conversations/js/frontend';
import '@concretecms/bedrock/assets/imagery/js/frontend';
import 'bootstrap-select/dist/js/bootstrap-select.min';
import 'ajax-bootstrap-select/dist/js/ajax-bootstrap-select.min';

// Custom assets
import composeMessage from '../../../messages/js/compose';

// Theme stuff
$("#ccm-toggle-mobile-nav").click(function (e) {
    e.preventDefault();

    const activeClass = "is-active";

    if ($(this).hasClass(activeClass)) {
        $(this).removeClass(activeClass);
    } else {
        $(this).addClass(activeClass);
    }
});

$(".send-message").click(function (e) {
    e.preventDefault();

    composeMessage($(this).data());
});