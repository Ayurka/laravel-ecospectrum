<div class="form-group">
    <label for="pageTitle">Название</label>
    <input name="title" class="form-control" id="pageTitle" type="text" placeholder="Название товара" value="{{ $product->title }}">
</div>
<div class="form-group">
    <label for="pageUrl">ЧПУ</label>
    <input name="slug" class="form-control" id="pageUrl" type="text" placeholder="ЧПУ страницы" value="{{ $product->slug }}">
</div>
<div class="form-group">
    <label for="pageDescription">Полное описание</label>
    <textarea name="description" class="form-control" id="pageDescription" rows="3">{{ $product->description }}</textarea>
</div>
<div class="form-group">
    <label for="seoTitle">SEO название страницы</label>
    <input name="seo_title" class="form-control" id="seoTitle" type="text" placeholder="" value="{{ $product->seo_title }}">
</div>
<div class="form-group">
    <label for="seoKeywords">SEO ключевые слова</label>
    <input name="seo_keywords" class="form-control" id="seoKeywords" type="text" placeholder="" value="{{ $product->seo_keywords }}">
</div>
<div class="form-group">
    <label for="seoDescription">SEO описание</label>
    <textarea name="seo_description" class="form-control" id="seoDescription" rows="3">{{ $product->seo_description }}</textarea>
</div>