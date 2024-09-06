<!DOCTYPE html>
<html>
<head>
    <title>Atlantis RCM Contact Us Mail!</title>
</head>
<body>
<p>Name: {{ $details['name'] }}</p>
<p>Email: {{ $details['email'] }}</p>
<p>Phone Number: {{ $details['phone'] }}</p>
<p>Speciality: {{ $details['specialty'] }}</p>
<p>Subject: {{ $details['subject'] }}</p>
<p>Contact For: {{ $details['contact_for'] }}</p>
<p>Message:<br>{{ $details['message'] }}</p>
<p>OPT IN OUT: {{ $details['opt_in_out']==1?'Yes':'No' }}</p>
<p>Thank you</p>
</body>
</html>
