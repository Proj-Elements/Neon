function search(text) {
    const encodedText = encodeURIComponent(text);
    window.location.href = `/search/${encodedText}`;
}
$(document).ready(function () {
    $("#search").on('keypress', function (event) {
        if (event.which === 13) {
            const content = $(this).val();
            search(content);
        }
    });
    $("#search_btn").on("click", function () {
        const content = $("#search").val();
        search(content);
    });
});