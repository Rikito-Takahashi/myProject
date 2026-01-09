console.log('follow script loaded');
require('./bootstrap');

console.log('follow script loaded');

console.log('follow.js loaded');



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// $('.follow-button').click(function () {
//     const followId = $(this).data('follow-id');
//     const button = $(this);

//     $.post('/follow', { follow_id: followId })
//         .done(function (data) {
//             if (data.status === 'followed') {
//                 button.text('フォロー解除');
//             } else {
//                 button.text('フォローする');
//             }
//         });
// });

$(document).on('click', '.follow-button', function () {
    console.log('フォローボタン押された');
    const followId = $(this).data('follow-id');
    const button = $(this);

    $.post('/follow', { follow_id: followId })
    .done(function (data) {
        console.log('success:', data);
        if (data.status === 'followed') {
            button.text('フォロー解除');
        } else {
            button.text('フォローする');
        }
    })
    .fail(function (xhr, status, error) {
        console.error('リクエスト失敗:', error);
    });
    });        
