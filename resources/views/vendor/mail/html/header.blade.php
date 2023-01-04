<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://static-contents-smartjen.s3.ap-southeast-1.amazonaws.com/img/smart-jen-logo-horizontal-v3.png" width="570" alt="Smart Jen Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
