<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMS</title>
    <!-- BOXICONS -->
    <!-- STYLE -->
</head>
<body>
<div id="main">
    <ul>
      <li class="nav-item"><a style="text-decoration: none;color:black" href="{{ route('login') }}">Home</li>
      <li class="nav-item"><a style="text-decoration: none;color:black" href="{{ route('login') }}">About</li>
      <li class="nav-item"><a style="text-decoration: none;color:black" href="{{ route('login') }}">Contact</li>
      <li class="nav-item"><a style="text-decoration: none;color:black" href="{{ route('login') }}">Register</li>
      <li class="nav-item"><a style="text-decoration: none;color:black" href="{{ route('login') }}">Login</a></li>
    </ul>
    <div class="gradient"></div>
    <div class="background-image"></div>
  </div>
</body>
</html>
<script>
    const menu= document.querySelector('#main')
    document.querySelectorAll('li').forEach((li, index) => {
      li.onmouseover = () => {
        menu.dataset.indexes= index;
      }
    })
    </script>
<style>
     * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgb(28, 28, 28);
}
body #main {
  position: relative;
  height: 110vh;
  display: flex;
  justify-content: center;
  flex-direction: column;
  overflow: hidden;
}
body #main ul {
  width: 20%;
  list-style-type: none;
  margin-left: 6rem;
}
body #main ul:hover > li {
  color: rgba(190, 190, 190, 0.5019607843);
}
body #main ul li {
  z-index: 0;
  font-size: 32px;
  padding-bottom: 20px;
  color: #f0f0f0;
  cursor: pointer;
  transition: all ease-in-out 0.3s;
}
body #main ul li:hover {
  color: #fff;
}
body #main .gradient {
  width: 100vw;
  height: 100vh;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
  background: radial-gradient(circle, #000000 10%, transparent 11%);
  background-size: 3em 3em;
  background-color: #3e3e3e;
}
a{
    text-decoration: none;
    color:black;
}
body #main[data-indexes="0"] .gradient {
  background-position: 0% -25%;
  transition: all ease-in-out 0.3s;
}
body #main[data-indexes="1"] .gradient {
  background-position: 0% -50%;
  transition: all ease-in-out 0.3s;
}
body #main[data-indexes="2"] .gradient {
  background-position: 0% -75%;
  transition: all ease-in-out 0.3s;
}
body #main[data-indexes="3"] .gradient {
  background-position: 0% -100%;
  transition: all ease-in-out 0.3s;
}
/* image */
body #main[data-indexes="0"] .background-image {
  width: 110vw;
  height: 110vh;
  transition: all ease-in-out 0.3s;
}
body #main[data-indexes="1"] .background-image {
  width: 120vw;
  height: 120vh;
  transition: all ease-in-out 0.3s;
}
body #main[data-indexes="2"] .background-image {
  width: 130vw;
  height: 130vh;
  transition: all ease-in-out 0.3s;
}
body #main[data-indexes="3"] .background-image {
  width: 140vw;
  height: 140vh;
  transition: all ease-in-out 0.3s;
}
#main .background-image{
  position: absolute;
  top: 0;
  left: 0;
  background:url("/images/a.jpg");
  width: 100vw;
  height: 100vh;
  opacity: 0.5;
  z-index: -1;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background-clip: border-box;
}
    </style>