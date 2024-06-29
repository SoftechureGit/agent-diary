<html>
<body>
<p>Hello <?= $name ?></p>
<p>Greeting For the Day!</p>
<p>Thank you for signing up for a Agent Diary Account – A Real Estate Sales Management System</p>
<p>While you’re exploring the feature of Agent Diary and getting to know how it can transform your business, Please also make sure to verify your email address so that we know it is really you.</p>
<p>
	<a href="<?= base_url('agent/confirm-mail/'.$email_confirm_code) ?>" style="padding: 10px 22px;background-color: #f8a15a;text-align: center;border: 1px solid #a56129;color:#000;text-decoration: none;border-radius: 50px;font-weight: 500;">Verify My Account</a>
</p>
<p style="padding-top: 12px;">In Case this Email was sent to you by mistake, kindly ignore.</p>
<div>
	<img src="<?= base_url('public/front/images/logo.png') ?>" style="height: 70px;">
</div>
<p><a href="https://agentdiary.com">https://agentdiary.com</a></p>
</body>
</html>