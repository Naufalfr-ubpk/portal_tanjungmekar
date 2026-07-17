<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images/logo-kkn.png') }}" class="logo" alt="Portal Tanjungmekar Logo" style="height: 50px;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>