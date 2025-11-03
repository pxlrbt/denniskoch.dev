
// 💡 Tooltips
document.querySelectorAll('[data-tooltip]').forEach(el => {
    const tooltip = el.getAttribute('data-tooltip');
    el.style.setProperty('anchor-name', '--'+tooltip);
    el.querySelector('[popover]').style.setProperty('position-anchor', '--'+tooltip);
});

// 🐘 Mastodon

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-mastodon-url]').forEach(container => {
        const mastodonPostUrl = container.getAttribute('data-mastodon-url');
        loadComments(mastodonPostUrl, container);
    });
});

const escapeHtml = (unsafe) => {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// Replace Emoji Short codes with their pictorial representation
const replaceEmoji = (string, emojis) => {
    emojis.forEach(emoji => {
        string = string.replaceAll(`:${emoji.shortcode}:`, `<img src="${escapeHtml(emoji.static_url)}" width="20" height="20">`)
    });
    return string;
}

const loadComments = async (mastodonPostUrl, container) => {
	if (! mastodonPostUrl) {
        return;
    }

    const id = mastodonPostUrl.split('/').pop();
    const mastodonApiUrl = mastodonPostUrl.replace(/@[^\/]+/, 'api/v1/statuses') + '/context';

    const response = await fetch(mastodonApiUrl);
    data = await response.json();

    if (data.length === 0) {
        container.innerHTML = '<p>No replies yet.</p>';
        return;
    }

    if (data.descendants) {
        container.innerHTML = data.descendants.reduce((html, status) => {
            return html + `
            <div class="mastodon-comment ${status.in_reply_to_id !== id ? '-nested' : ''}">
                <a target="_blank" class="date" href="${status.url}" rel="nofollow">
                    <header>
                        <div class="mastodon-comment__avatar">
                            <img src="${status.account.avatar_static}" height="60" width="60" loading="lazy" alt="">
                        </div>

                        <div class="mastodon-comment__meta">
                            <span class="mastodon-comment__author">
                                ${replaceEmoji(escapeHtml(status.account.display_name), status.account.emojis)}
                            </span>

                            <time  class="mastodon-comment__date" datetime="${status.created_at}">
                                ${new Date(status.created_at).toLocaleString()}
                            </time>
                        </div>
                    </header>
                </a>

                <div class="mastodon-comment__body">
                    ${replaceEmoji(status.content, status.emojis)}
                </div>
            </div>
        `}, '');
    }
}
