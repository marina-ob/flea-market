document.getElementById('file-upload').addEventListener('change', function(event) {
    let fileName = event.target.files.length > 0 ? event.target.files[0].name : "選択されていません";
    document.getElementById('file-name').textContent = fileName;
});

function removePlaceholderOption(select) {
    let firstOption = select.options[0];
    if (firstOption.value === "") {
        select.remove(0);
    }
}