<p class="p-desc text-center"></p>
<hr>

<script>
    let pDesc = document.querySelector('p.p-desc');
    let text = "به بهترین فایل‌ها و پکیج‌های آموزشی دسترسی داشته باشید. کیفیت و تجربه کاربری بالا تضمین شده است.";
    let index = 0;

    let interval = setInterval(() => {

        pDesc.textContent += text[index];
        index++;


        if (index >= text.length) {
            clearInterval(interval);
        }
    }, 100); 
</script>
