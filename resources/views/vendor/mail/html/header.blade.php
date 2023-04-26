<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('dist/img/realtyplus_logo.png') }}" class="logo" alt="{{ config('app.name') }}">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>