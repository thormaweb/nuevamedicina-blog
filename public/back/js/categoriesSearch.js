function matchStart (term, text, element) {

    if (text.toUpperCase().indexOf(term.toUpperCase()) >= 0) {
        return true;
    }

    return loopElementBottom( $(element.element), term ) || loopElementTop( $(element.element), term);
}

function loopElementBottom( element, term ) {

    var answer = false;

    $("option[data-parent='" + $(element).val() + "']").each( function ( index, element ) {

        if ( $(element).text().toUpperCase().indexOf(term.toUpperCase() ) >= 0) {

            answer = true;
            return false;
        } else {

            if ($(element).data("children") == true) {

                if (loopElementBottom( element, term )) {
                    answer = true;
                    return false;
                }
            }
        }
    });

    return answer;
}

function loopElementTop ( element, term ) {

    if ($(element).data('parent') != 0) {

        var element2 = $("option[value='" + $(element).data('parent') + "']");

        if (element2.text().toUpperCase().indexOf(term.toUpperCase() ) >= 0) {
            return true;
        }

        return loopElementTop( element2, term );
    }

    return false;
}