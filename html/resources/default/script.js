// Check local storage for item, if enabled then enables dark mdoe
document.addEventListener('DOMContentLoaded', function() {
  var darkStyle = document.getElementById('darkStyle');
  var darkMode = localStorage.getItem('darkMode');
  if (darkMode === 'enabled') {
    enableDarkMode();
  }

  function enableDarkMode() {
    darkStyle.disabled = false;
  }
});
