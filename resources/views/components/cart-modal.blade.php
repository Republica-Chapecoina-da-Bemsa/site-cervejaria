<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">
                    <i class="bi bi-cart3"></i> Carrinho de Compras
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cart-items-container">
                    <div class="text-center py-5">
                        <p class="text-muted">Carregando...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total:</h5>
                        <h5 id="cart-total">R$ 0,00</h5>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar Comprando</button>
                        <button type="button" class="btn btn-danger" id="clear-cart">
                            <i class="bi bi-trash"></i> Limpar
                        </button>
                        <button type="button" class="btn btn-primary flex-grow-1">Finalizar Pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartCount = document.getElementById('cart-count');
        const cartItemsContainer = document.getElementById('cart-items-container');
        const cartTotal = document.getElementById('cart-total');
        const clearCartBtn = document.getElementById('clear-cart');

        updateCartCount();

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.dataset.productId;

                fetch('{{ route("cart.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartCount();
                            showNotification(data.message);
                        }
                    });
            });
        });

        document.getElementById('cartModal').addEventListener('show.bs.modal', function() {
            loadCart();
        });

        clearCartBtn.addEventListener('click', function() {
            if (confirm('Deseja realmente limpar o carrinho?')) {
                fetch('{{ route("cart.clear") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartCount();
                            loadCart();
                            showNotification(data.message);
                        }
                    });
            }
        });

        function updateCartCount() {
            fetch('{{ route("cart.index") }}')
                .then(response => response.json())
                .then(data => {
                    cartCount.textContent = data.count;
                    if (data.count === 0) {
                        cartCount.style.display = 'none';
                    } else {
                        cartCount.style.display = 'inline-block';
                    }
                });
        }

        function loadCart() {
            fetch('{{ route("cart.index") }}')
                .then(response => response.json())
                .then(data => {
                    if (Object.keys(data.cart).length === 0) {
                        cartItemsContainer.innerHTML = `
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x" style="font-size: 3rem; color: #6c757d;"></i>
                            <p class="mt-3 text-muted">Seu carrinho está vazio</p>
                        </div>
                    `;
                    } else {
                        let html = '<div class="cart-items">';

                        for (const [id, item] of Object.entries(data.cart)) {
                            html += `
                            <div class="cart-item border-bottom pb-3 mb-3">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        ${item.image 
                                            ? `<img src="/storage/${item.image}" class="img-fluid rounded" alt="${item.name}">` 
                                            : `<div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 60px;">
                                                <i class="bi bi-cup-straw text-muted"></i>
                                              </div>`
                                        }
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-1">${item.name}</h6>
                                        <small class="text-muted">R$ ${parseFloat(item.price).toFixed(2).replace('.', ',')}</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm">
                                            <button class="btn btn-outline-secondary qty-minus" data-product-id="${id}">-</button>
                                            <input type="number" class="form-control text-center qty-input" value="${item.quantity}" data-product-id="${id}" min="1" style="max-width: 50px;">
                                            <button class="btn btn-outline-secondary qty-plus" data-product-id="${id}">+</button>
                                        </div>
                                        <button class="btn btn-sm btn-link text-danger p-0 mt-1 remove-item" data-product-id="${id}">
                                            <i class="bi bi-trash"></i> Remover
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        }

                        html += '</div>';
                        cartItemsContainer.innerHTML = html;

                        document.querySelectorAll('.qty-minus, .qty-plus').forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.dataset.productId;
                                const input = document.querySelector(`.qty-input[data-product-id="${productId}"]`);
                                let qty = parseInt(input.value);

                                if (this.classList.contains('qty-minus') && qty > 1) {
                                    qty--;
                                } else if (this.classList.contains('qty-plus')) {
                                    qty++;
                                }

                                updateQuantity(productId, qty);
                            });
                        });

                        document.querySelectorAll('.qty-input').forEach(input => {
                            input.addEventListener('change', function() {
                                const productId = this.dataset.productId;
                                const qty = parseInt(this.value) || 1;
                                updateQuantity(productId, qty);
                            });
                        });

                        document.querySelectorAll('.remove-item').forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.dataset.productId;
                                removeItem(productId);
                            });
                        });
                    }

                    cartTotal.textContent = `R$ ${parseFloat(data.total).toFixed(2).replace('.', ',')}`;
                });
        }

        function updateQuantity(productId, quantity) {
            fetch('{{ route("cart.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartCount();
                        loadCart();
                    }
                });
        }

        function removeItem(productId) {
            fetch('{{ route("cart.remove") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartCount();
                        loadCart();
                    }
                });
        }

        function showNotification(message) {
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 p-3';
            toast.style.zIndex = '11';
            toast.innerHTML = `
            <div class="toast show" role="alert">
                <div class="toast-body">
                    <i class="bi bi-check-circle text-success"></i> ${message}
                </div>
            </div>
        `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    });
</script>