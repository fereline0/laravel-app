<footer class="bg-gray-900 text-white py-6">
    <div class="max-w-7xl text-white mx-auto spacer-y-10 px-4">
        <div class="space-y-4">
            <div>
                <a class="inline-flex items-center
    hover:text-white text-gray-200 focus:outline-none transition
    ease-in-out duration-300"
                    href="{{ route('home') }}">
                    <h2 class="text-xl font-medium">
                        {{ config('app.name', 'Laravel') }}</h2>
                </a>
                <p>Исследуйте мир литературы с нашим книжным магазином! Мы предлагаем богатый выбор книг всех жанров —
                    от классики, которая проверена временем, до современных бестселлеров, которые завоевали сердца
                    читателей. У нас есть всё, чтобы удовлетворить вашу страсть к чтению и помочь вам найти следующую
                    любимую книгу.</p>
            </div>
            <div>
                <h5 class="text-lg font-medium">Контакты</h5>
                <p>Email: {{ $contactInfo->email }}</p>
                <p>Телефон: {{ $contactInfo->phone }}</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>&copy; {{ date('Y') }} Книжный Магазин. Все права защищены.</p>
        </div>
</footer>
