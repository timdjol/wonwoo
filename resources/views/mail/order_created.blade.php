<p>@lang('mail.dear') {{ $name }}</p>

<p>@lang('mail.order_sum') {{ $fullSum }} {{ $order->currency->symbol }} @lang('mail.order_create')</p>

<table>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>
                <a href="{{ route('product', [$product->category->code, $product->code, $product->id]) }}">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->__('title') }}">
                    {{ $product->__('title') }}
                </a>
            </td>
            <td>
                <span class="badge">{{ $product->countInOrder }}</span>
            </td>
            <td>{{ $product->price }} {{ $order->currency->symbol }}</td>
            <td>{{ $product->getPriceForCount() }} {{ $order->currency->symbol }}</td>
        </tr>
    @endforeach
    </tbody>
</table>