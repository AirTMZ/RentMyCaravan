document.addEventListener('DOMContentLoaded', function() {
  var darkStyle = document.getElementById('darkStyle');
  var darkMode = localStorage.getItem('darkMode');
  if (darkMode === 'enabled') {
    enableDarkMode();
  }

  function enableDarkMode() {
    darkStyle.disabled = false;
  }

  function disableDarkMode() {
    darkStyle.disabled = true;
  }

  // Adds event listener to moon element,
  var imageButton = document.getElementById('imageButton');
  imageButton.addEventListener('click', function() {
    var darkMode = localStorage.getItem('darkMode');
    if (darkMode !== 'enabled') {
      enableDarkMode();
      localStorage.setItem('darkMode', 'enabled');
    } else {
      disableDarkMode();
      localStorage.setItem('darkMode', null);
    }
  });
});
