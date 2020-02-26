import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import '@ckeditor/ckeditor5-build-classic/build/translations/ru';

let editors = document.querySelectorAll('.editor');
for (let i = 0; i < editors.length; ++i) {
    ClassicEditor
        .create(editors[i], {
            language: 'ru'
        })
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( 'There was a problem initializing the editor.', error );
        } );
}
