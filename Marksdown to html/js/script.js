// Add an event listener to the textarea for input changes
document.getElementById('markdownInput').addEventListener('input', function() {
    // Get the Markdown input
    const markdown = this.value;

    // Get the HTML output area
    const htmlOutput = document.getElementById('htmlOutput');
    // Convert Markdown to HTML and display in the output area
    htmlOutput.innerHTML = convertMarkdownToHtml(markdown);
});

// Function to convert Markdown to HTML
function convertMarkdownToHtml(markdown) {
    let lines = markdown.split('\n');
    let html = '';

    let inCodeBlock = false;

    // Process each line individually
    lines.forEach(line => {
        // Code blocks
        if (/^```/.test(line)) {
            if (!inCodeBlock) {
                inCodeBlock = true;
                html += '<pre><code>';
            } else {
                inCodeBlock = false;
                html += '</code></pre>';
            }
        } else if (inCodeBlock) {
            // Inside a code block, just add the line as is
            html += `${line}\n`;
        } else {
            // Headers
            if (/^######/.test(line)) {
                html += `<h6>${line.replace(/^######\s*/, '')}</h6>`;
            } else if (/^#####/.test(line)) {
                html += `<h5>${line.replace(/^#####\s*/, '')}</h5>`;
            } else if (/^####/.test(line)) {
                html += `<h4>${line.replace(/^####\s*/, '')}</h4>`;
            } else if (/^###/.test(line)) {
                html += `<h3>${line.replace(/^###\s*/, '')}</h3>`;
            } else if (/^##/.test(line)) {
                html += `<h2>${line.replace(/^##\s*/, '')}</h2>`;
            } else if (/^#/.test(line)) {
                html += `<h1>${line.replace(/^#\s*/, '')}</h1>`;
            }
            // Lists
            else if (/^\s*([-+*]|\d+\.)\s+/.test(line)) {
                if (/^\d+\./.test(line)) {
                    let marker = line.match(/^\d+\./)[0];
                    let content = line.replace(/^\d+\./, '').trim();
                    html += `<ol><li value="${parseInt(marker)}">${content}</li></ol>`;
                } else {
                    html += `<ul><li>${line.replace(/^([-+*])\s*/, '').trim()}</li></ul>`;
                }
            }
            // Blockquotes
            else if (/^>/.test(line)) {
                html += `<blockquote>${line.replace(/^>\s*/, '')}</blockquote>`;
            }
            // Emphasis
            else {
                html += line.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                            .replace(/\*(.*?)\*/g, '<em>$1</em>')
                            .replace(/!\[(.*?)\]\((.*?)\)/g, '<img alt="$1" src="$2">')
                            .replace(/\[(.*?)\]\((.*?)\)/g, '<a href="$2">$1</a>')
                            .replace(/___(.*)$/, '<hr>')
                            .replace(/\{\{(.*?)\|(.*?)\}\}/g, (match, color, content) => {
                                return `<span style="color: ${color}">${convertMarkdownToHtml(content)}</span>`;
                            });
            }
        }
    });

    return html;
}