// Check for saved dark mode setting in localStorage
window.onload = function() {
  var darkMode = localStorage.getItem('darkMode');
  if (darkMode === 'enabled') {
    enableDarkMode();
  }
};

// Function to enable dark mode
function enableDarkMode() {
  var darkStyle = document.getElementById('darkStyle');
  darkStyle.disabled = false;
}

// Function to disable dark mode
function disableDarkMode() {
  var darkStyle = document.getElementById('darkStyle');
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
