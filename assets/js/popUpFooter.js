function closeFooterPopup() {
  // Get values
  const name = document.getElementById('rd-text_field-kjvd1wkn').value;
  const email = document.getElementById('rd-email_field-kjvd1wko').value;
  const funcao = document.getElementById('rd-select_field-kjvd1wkp').value;
  const rgpd = document.querySelector('#rd-checkbox_field-kjvd1wkq').checked;

  // Check if form has been filled correctly

  if (name !== '' && email !== '' && funcao !== '' && rgpd !== false) {
    if (email.includes('@') && email.includes('.')) {
      // Close the form!
      setTimeout(() => {
        document.querySelector('.popmake-close').click();
      }, 1000);
    }
  }
}

// Get elements only once the form gets opened!
document.querySelector('.pelica-news-btn').addEventListener('click', () => {
  // Wait for form to open
  setTimeout(() => {
    // Call function on submit button
    document
      .getElementById('rd-button-kjoi7s65')
      .addEventListener('click', () => {
        closeFooterPopup();
      });
  }, 3000);
});
