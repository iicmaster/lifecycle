<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Feedback</title>
</head>
<body>
<div>
  <form action="<?php echo base_url(); ?>/main/feedback/" method="post">
    <ul>
      <li>
        <input id="feedback" name="type" type="radio" value="0" checked />
        <label for="feedback">Feedback</label>
        <input id="bug" name="type" type="radio" value="1" />
         <label for="bug">Bug Report </li></label>
      <li>
        <label for="topic">Topic</label>
        <input id="topic" name="topic" type="text" />
      </li>
      <li>
        <label for="detail">Detail</label>
        <textarea id="detail" name="detail"></textarea>
      </li>
      <li>
        <input type="submit" value="  OK  " />
      </li>
    </ul>
  </form>
</div>
</body>
</html>