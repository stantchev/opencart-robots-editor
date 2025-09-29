# Robots.txt Editor & Cache Control за OpenCart 2.3.0.2

Модул за OpenCart 2.3.0.2, който позволява:
- директна редакция на **robots.txt** от админ панела;
- селективно изчистване само на кеша на robots.txt;
- незабавна проверка на промените чрез `curl` или SEO инструменти.

Създаден за SEO специалисти и администратори, които искат бърз достъп и пълен контрол без нужда от FTP/SSH.

---

## ✨ Основни функции

- 📂 **Редакция на robots.txt** – през удобен интерфейс в админ панела.  
- ⚡ **Clear Cache бутон** – премахва само кеша на robots.txt, без да засяга останалата система.  
- 🔍 **SEO Ready** – промените са видими веднага за crawler-и, Screaming Frog, Google Search Console и др.  
- 🛡️ **Без риск** – не изисква промени по ядрото, всичко е реализирано с OCMOD.  

---

## 📦 Структура на модула

```
stanchevseo-editrobots.ocmod.zip
│
├── admin/
│   ├── controller/extension/module/robots_editor.php
│   ├── language/bg-bg/extension/module/robots_editor.php
│   └── view/template/extension/module/robots_editor.tpl
│
├── install.xml (или robots_editor.ocmod.xml)
└── README.md
```

---

## 🚀 Инсталация

1. Влезте в OpenCart админ панела.  
2. Отидете на **Extensions → Installer**.  
3. Качете файла `stanchevseo-editrobots.ocmod.zip`.  
4. Отидете на **Extensions → Modifications** и натиснете **Refresh**.  
5. Отидете на **Extensions → Modules** и активирайте **Robots Editor**.  

---

## ⚙️ Използване

1. В админ панела отидете на **Extensions → Modules → Robots Editor**.  
2. В текстовото поле редактирайте съдържанието на `robots.txt`.  
3. Натиснете **Запази**, за да приложите промените.  
4. Натиснете бутона **Clear robots.txt cache**, за да изчистите само кеша на robots.txt.  
5. Проверете резултата с:

```bash
curl -I https://yourdomain.com/robots.txt
```

---

## 🖼️ Интерфейс (пример)

```html
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="input-robots">robots.txt</label>
    <textarea name="robots_content" rows="20" class="form-control"><?php echo $robots_content; ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Запази</button>
  <a href="<?php echo $clear_cache; ?>" class="btn btn-warning">Clear robots.txt cache</a>
</form>
```

---

## 🧑‍💻 Примерен метод в контролера

```php
public function clearCache() {
    $this->load->language('extension/module/robots_editor');

    // Изчистване само на robots.txt кеша
    $this->cache->delete('robots.txt');

    $this->session->data['success'] = $this->language->get('text_success_cache');
    $this->response->redirect(
        $this->url->link('extension/module/robots_editor', 
        'user_token=' . $this->session->data['user_token'], true)
    );
}
```

---

## ✅ Стъпки за репродуциране

1. Инсталирайте модула през **Extensions → Modules**.  
2. Отворете **Robots Editor** в админ панела.  
3. Редактирайте съдържанието на robots.txt и запазете.  
4. Натиснете бутона **Clear robots.txt cache**.  
5. Проверете с `curl` или SEO инструмент – трябва да получите актуалната версия.  

---

## 📊 Резултат

- Незабавна видимост на новото съдържание за crawler-и.  
- Край на проблемите със стари кеширани версии.  
- SEO екипите могат да работят бързо и сигурно, без технически бариери.  

---

## 📜 Лиценз

Този проект е публикуван под **GNU GPL v3 License**.  
Можете свободно да използвате, модифицирате и разпространявате кода, при условие че всички производни работи също бъдат лицензирани под GPL v3.  

➡️ Пълният текст на лиценза можете да намерите в [LICENSE](./LICENSE).

---

👨‍💻 Разработено от **Станчев** – OpenCart & E-commerce Specialist.
