// getElementById wrapper
function $id(id) {
  return document.getElementById(id);
}

// asyncrhonously fetch the html template partial from the file directory,
// then set its contents to the html of the parent element
function loadHTML(url, id) {
  req = new XMLHttpRequest();
  req.open('GET', url);
  req.send();
  req.onload = () => {
    $id(id).innerHTML = req.responseText;
  };
}

// use #! to hash
router = new Navigo(null, true, '#');
router.on({
  // 'view' is the id of the div element inside which we render the HTML
  'auth/login': () => {
    prepareLogin('./app/views/auth/login.html');
  },
  'user/profile': () =>{
    showProfilePage('./app/views/user/profile.html');
  },
  'user/profile/update': () => {
    showUpdateProfilePage('./app/views/auth/update-profile.html');
  },
  'user/profile/users/signup': () => {
    showSignupForm('./app/views/auth/signup.html');
  },
  'user/profile/users': () => {

  },
  'user/profile/lock-screen': () => {
    showLockscreen('./app/views/auth/lock-screen.html');
  },
  'auth/email/verify/:id': (params, query) =>{
    showVerifyAccount('./app/views/auth/verify-account.html', params, query);
  },
  'auth/password/reset': (params, query) =>{
    showResetPassword('./app/views/auth/reset-password.html', params, query);
  },
  'auth/password/reset-link': () =>{
    showRequestPassForm('./app/views/auth/forgot-password.html');
  },
  'user/profile/users/:id/user-details': () =>{

  },
  'user/payment': () =>{

  }
});

// set the default route
router.on(() => {
  showDefaultPage('./app/views/default.html');
});

// set the 404 route
router.notFound((query) => { showErrorPage('./app/views/errorpage.html'); });

router.resolve();
