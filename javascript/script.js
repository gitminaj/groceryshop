let profile = document.querySelector('.profile');

document.querySelector('#user').onclick = () => {
  profile.classList.toggle('active');
}

window.onscroll = () => {
  profile.classList.remove('active');
}


