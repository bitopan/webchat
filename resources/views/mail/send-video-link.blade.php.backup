<!DOCTYPE html>
<html>
<head>
	<title>Video Link</title>
</head>
<body>
<b>Hi {{ $name }}!</b>

<p>
	You have one video conference request for telemedicine with {{ $other_name }}
</p>

<p>
	Please click <a href="https://chat.geekworkx.net/conference/{{ $token }}">Click Here</a> to start the conference.
</p>

<p>
	<div><b>Your Meeting ID:</b> {{ $room }}</div>
	<div><b>Password:</b> {{ $password }}</div>
</p>

<p>
	@if($isDoctor == 1)
		<table>
			<tr>
				<td style="font-weight: bold">Patient Name: </td>
				<td>{{ $details["name"] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold">Patient Email: </td>
				<td>{{ $details["email"] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold">Patient Phone: </td>
				<td>{{ $details["phone"] }}</td>
			</tr>
		</table>
	@else
		<table>
			<tr>
				<td style="font-weight: bold">Doctor Name: </td>
				<td>{{ $details["name"] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold">Doctor Email: </td>
				<td>{{ $details["email"] }}</td>
			</tr>
			<tr>
				<td style="font-weight: bold">Doctor Phone: </td>
				<td>{{ $details["phone"] }}</td>
			</tr>
		</table>
	@endif
</p>

<p>
	<b>Regards,</b>
	<p>
		downtown hospital
	</p>
</p>
</body>
</html>