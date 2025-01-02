document.addEventListener('DOMContentLoaded', () => {
  const closeAllElements = () => {
    document
      .querySelectorAll('.provider-slidetoggle-target')
      .forEach((target) => {
        target.style.transition = 'max-height 0.3s ease, opacity 0.3s ease';
        target.style.opacity = '0';
        target.style.maxHeight = '0';
        target.style.display = 'none';
      });
  };

  document.querySelectorAll('.provider-slidetoggle-listt').forEach((item) => {
    item.addEventListener('click', (event) => {
      event.preventDefault();

      const targetId = 'lud_' + item.getAttribute('data-r');
      const targetElement = document.getElementById(targetId);

      const isOpen =
        targetElement &&
        targetElement.style.maxHeight &&
        targetElement.style.maxHeight !== '0px';

      closeAllElements();

      if (targetElement && !isOpen) {
        targetElement.style.display = 'block';
        targetElement.style.opacity = '0';
        targetElement.style.maxHeight = '0';
        setTimeout(() => {
          targetElement.style.transition =
            'max-height 0.3s ease, opacity 0.3s ease';
          targetElement.style.opacity = '1';
          targetElement.style.maxHeight = targetElement.scrollHeight + 'px';
        }, 10);
      }
    });
  });
});
