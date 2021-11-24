setTimeout(() => {
  const word = document.querySelectorAll('.progress-description');
  const url = window.location.href;

  word.forEach(element => {
    if (url.includes('/en/')) {
      if (element.innerText === 'Iniciante') {
        element.innerText = 'Beginner';
      } else if (element.innerText === 'Médio') {
        element.innerText = 'Medium';
      } else if (element.innerText === 'Avançado') {
        element.innerText = 'Expert';
      }
    }
  });
}, 2000);


setTimeout(() => {
    const injectFunction = (index, content, cl) => {
        const speakers = document.querySelectorAll('.brk-team-staff__description');
        const speaker = speakers[index].getElementsByTagName('h4');
        // Create an element
        const newElement = document.createElement("span");
        // Add Classes to the new element
        newElement.classList.add(cl);
        // Create the text for the element
        const text = document.createTextNode(content);
        // Add the text to the element
        newElement.appendChild(text);
        // Add the new element to the speaker
        speaker[0].appendChild(newElement);
    }

    injectFunction(0,'Webinar Big Data', 'pelican-funcao-orador');
    injectFunction(1,'Webinar Data Science', 'pelican-funcao-orador');
    injectFunction(2,'Webinar BI & Analytics', 'pelican-funcao-orador');


}, 2500);

