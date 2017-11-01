function tag_action(type) {
    if (type != 'export' && $('.check').filter(':checked').length == 0) {
        alert('Please select the tag to ' + type);
        return false;
    }
    if (confirm('Are you sure want to ' + type + '?')) {
        $('#action_type').val(type);
        $('#tag_form').submit();
    }
}

function news_action(type) {
    if (type != 'export' && $('.check').filter(':checked').length == 0) {
        alert('Please select the news item to ' + type);
        return false;
    }
    if (confirm('Are you sure want to ' + type + '?')) {
        $('#action_type').val(type);
        $('#news_form').submit();
    }
}

function faq_action(type) {
    if (type != 'export' && $('.check').filter(':checked').length == 0) {
        alert('Please select the FAQ item to ' + type);
        return false;
    }
    if (confirm('Are you sure want to ' + type + '?')) {
        $('#action_type').val(type);
        $('#faq_form').submit();
    }
}

function review_action(type) {
    if (type != 'export' && $('.check').filter(':checked').length == 0) {
        alert('Please select the review item to ' + type);
        return false;
    }
    if (confirm('Are you sure want to ' + type + '?')) {
        $('#action_type').val(type);
        $('#review_form').submit();
    }
}
