// Store the dark style element in a variable for reuse
var darkStyle = document.getElementById('darkStyle');

// Check for saved dark mode setting in localStorage
document.addEventListener('DOMContentLoaded', function() {
  var darkMode = localStorage.getItem('darkMode');
  if (darkMode === 'enabled') {
    enableDarkMode();
  }
});

// Function to enable dark mode
function enableDarkMode() {
  darkStyle.disabled = false;
}

// Function to disable dark mode
function disableDarkMode() {
  darkStyle.disabled = true;
}

// Event listener for the dark mode toggle button
document.getElementById('imageButton').addEventListener('click', function() {
  var darkMode = localStorage.getItem('darkMode');
  if (darkMode !== 'enabled') {
    enableDarkMode();
    localStorage.setItem('darkMode', 'enabled');
  } else {
    disableDarkMode();
    localStorage.setItem('darkMode', null);
  }
});
