<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
body{
  background-color: steelblue;
}
#caja{
  position: absolute; /* or absolute */
  top: 50%;
  left: 50%;
  width:600px;
  height:600px;
  margin-top: -300px;
  margin-left: -300px;  
  border: 1px solid #999999;
  background-color:#FFFFFF;
  border-radius: 20px;
  box-shadow: 7px 7px 20px #999;
 
}
FORM{
	margin:200px 200px 50px 200px;
}
</style>
</head>

<body>
<div class="caja" id="caja">
  <form name="form1" method="post" action="acceso.php">
    <table width="100%" border="0">
      <tr>
        <td>Login</td>
        <td><label for="login"></label>
        <input type="text" name="login" id="login" required></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><label for="password"></label>
        <input type="password" name="password" id="password"></td>
      </tr>
    </table>
    <input type="submit" name="button" id="button" value="Entrar">
  </form>
</div>
</body>
</html>