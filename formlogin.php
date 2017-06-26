<script type="text/javascript">
function Blank_TextField_Validator()
{
if (text_form.username.value == "")
{
   alert("Isi username !");
   text_form.username.focus();
   return (false);
}
if (text_form.password.value == "")
{
   alert("isi password !");
   text_form.password.focus();
   return (false);
}
if (text_form.tipe.value == "")

return (true);
}
</script>
<center>
<h6 class="red">Login</h6>
<form method='post' action='ceklogin.php' name=text_form onsubmit='return Blank_TextField_Validator()'>
        <table>
        <tr>
        <td align=center><input type='text' name='username' size='15' placeholder='Username'></td>
		</tr>
        <tr>
        <td align=center><input type='password' name='password' size='15' placeholder='Password'></td>
		</tr>
		<tr><td align=center><input type=submit name=submit title='Login' alt='Login' value='          Login          ' /></td></tr>
        </table>
      </form>
</center>
<br>
