document.addEventListener('DOMContentLoaded', function () {
  const tabLinks = document.querySelectorAll('.tab-link');
  const tabContents = document.querySelectorAll('.tab-content');

  function deactivateAll() {
    tabLinks.forEach((link) => link.classList.remove('is-active'));
    tabContents.forEach((content) => (content.style.display = 'none'));
  }

  if (tabLinks.length > 0 && tabContents.length > 0) {
    tabLinks[0].classList.add('is-active');
    tabContents[0].style.display = 'block';
  }

  tabLinks.forEach((link, index) => {
    link.addEventListener('click', function () {
      deactivateAll();

      link.classList.add('is-active');
      tabContents[index].style.display = 'block';
    });
  });
});
