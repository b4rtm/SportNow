document.addEventListener("DOMContentLoaded", function() {
    var coll = document.getElementsByClassName("filter");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
});

function changeFilter(key, value) {
    var currentURL = window.location.href;
    var url = new URL(currentURL);
    var searchParams = url.searchParams;

    if (searchParams.has(key)) {
        if (value !== "delete") searchParams.set(key, value);
        else searchParams.delete(key)
    } else if (value !== "delete") {
        searchParams.append(key, value);
    }

    window.location.href = url.toString();
}

function toggleCheckbox(checkbox, type, value) {
    if (checkbox.checked) {
        changeFilter(type, value);
    } else {
        changeFilter(type, 'delete');
    }
}