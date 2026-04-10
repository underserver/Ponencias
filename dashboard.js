document.addEventListener('DOMContentLoaded', function() {
    const widgets = document.querySelectorAll('.widget');
    widgets.forEach(widget => {
        widget.addEventListener('click', function() {
            alert(`You clicked on ${this.querySelector('h2').innerText}`);
        });
    });
});
