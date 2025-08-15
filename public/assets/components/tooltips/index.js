document.querySelectorAll('[data-tooltip]').forEach(el => {
    const tooltip = el.getAttribute('data-tooltip');

    el.style = 'anchor-name: --'+tooltip+';';
    el.querySelector('.tooltip').style = 'position-anchor: --'+tooltip+';';
});
