document.addEventListener('DOMContentLoaded', function () {
  var sliders = document.querySelectorAll('[id^="polzunok_"]');

  sliders.forEach(function (slider) {
    var name = slider.id.replace('polzunok_', '');
    var maxVal = parseInt(slider.getAttribute('data-max'), 10) || 1000;
    var step = 10;

    var rangeInput = document.createElement('input');
    rangeInput.type = 'range';
    rangeInput.min = 0;
    rangeInput.max = maxVal;
    rangeInput.step = step;
    rangeInput.value = 0;
    rangeInput.className = 'custom-slider';

    slider.appendChild(rangeInput);

    var valueDisplay = document.createElement('span');
    valueDisplay.id = 'slider_value_' + name;
    valueDisplay.textContent = rangeInput.value;
    slider.appendChild(valueDisplay);

    rangeInput.addEventListener('input', function () {
      var value = rangeInput.value;
      valueDisplay.textContent = value;
      document.getElementById(name).value = value;
    });
  });
});
