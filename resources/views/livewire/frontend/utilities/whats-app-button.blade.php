@props(['phone' => '15551234567'])

<div x-data="{ open: false, message: '' }" class="wa-widget-container">

    <!-- Chat Window -->
    <div class="wa-chat-box" x-show="open" x-transition.scale.origin.bottom.right style="display: none;">
        <!-- Header -->
        <div class="wa-header">
            <div class="wa-avatar">
                <img src="https://ui-avatars.com/api/?name=Support&background=25D366&color=fff" alt="Support">
            </div>
            <div class="wa-header-info">
                <div class="wa-title">Syntax Corporation</div>
                <div class="wa-subtitle">Typically replies within 1 hour</div>
            </div>
            <div class="wa-close" @click="open = false">&times;</div>
        </div>

        <!-- Body -->
        <div class="wa-body">
            <div class="wa-message">
                <div class="wa-name">Syntax Corporation</div>
                Hello! 👋 <br> How can we help you today?
                <div class="wa-time">{{ now()->format('H:i') }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="wa-footer">
            <input type="text" x-model="message" placeholder="Type a message..." @keydown.enter="sendMessage()">
            <button @click="sendMessage()">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="#919191">
                    <path d="M1.101 21.757 23.8 12.028 1.101 2.3l.011 7.912 13.623 1.816-13.623 1.817-.011 7.912z"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Toggle Button -->
    <button class="wa-toggle" @click="open = !open">
        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="#FFF">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
        </svg>
    </button>

    <script>
        function sendMessage() {
            let input = document.querySelector('.wa-footer input');
            let text = input.value;
            if (text.trim() === '') return;
            let phone = "{{ $phone }}";
            window.open(`https://wa.me/${phone}?text=${encodeURIComponent(text)}`, '_blank');
            input.value = '';
        }
    </script>

    <style>
        .wa-widget-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            font-family: sans-serif;
        }

        .wa-toggle {
            width: 60px;
            height: 60px;
            background: #25D366;
            border-radius: 50%;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .wa-toggle:hover {
            transform: scale(1.1);
        }

        .wa-chat-box {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 350px;
            background: #e5ddd5;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-image: url("https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png");
        }

        .wa-header {
            background: #075e54;
            padding: 15px;
            display: flex;
            align-items: center;
            color: white;
            gap: 10px;
        }

        .wa-avatar img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .wa-header-info {
            flex: 1;
        }

        .wa-title {
            font-weight: bold;
            font-size: 16px;
        }

        .wa-subtitle {
            font-size: 12px;
            opacity: 0.8;
        }

        .wa-close {
            cursor: pointer;
            font-size: 24px;
            opacity: 0.7;
        }

        .wa-body {
            padding: 20px;
            height: 250px;
            overflow-y: auto;
        }

        .wa-message {
            background: white;
            padding: 10px;
            border-radius: 0 10px 10px 10px;
            font-size: 14px;
            position: relative;
            width: fit-content;
            max-width: 85%;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .wa-message::before {
            content: '';
            position: absolute;
            top: 0;
            left: -8px;
            border: 8px solid transparent;
            border-top-color: white;
        }

        .wa-name {
            font-size: 12px;
            color: #888;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .wa-time {
            font-size: 10px;
            color: #999;
            text-align: right;
            margin-top: 5px;
        }

        .wa-footer {
            background: #f0f0f0;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .wa-footer input {
            flex: 1;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            outline: none;
            font-size: 14px;
        }

        .wa-footer button {
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</div>