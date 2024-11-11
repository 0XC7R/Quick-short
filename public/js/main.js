function CopyClip() {
    const inputElement = document.getElementById("urlbox");

    if (inputElement) {
        const valueToCopy = inputElement.value;

        // Check if we can use the clipboard API
        if (navigator.clipboard) {
            // Use the Clipboard API to copy the value
            navigator.clipboard.writeText(valueToCopy)
                .then(function () {
                    alert("Value copied to clipboard!");
                })
                .catch(function (err) {
                    console.error("Error copying to clipboard: ", err);
                    alert("Failed to copy text.");
                });
        } else { 
            
            // Fallback for older browsers / if we cannot use Navigator.clipboard. using execCommand
            const textArea = document.createElement('textarea');
            textArea.value = valueToCopy;
            document.body.appendChild(textArea);
            textArea.select();
            const successful = document.execCommand('copy');
            document.body.removeChild(textArea);

            if (successful) {
                alert("Value copied to clipboard (fallback method)!");
            } else {
                alert("Failed to copy text (fallback method).");
            }
        }
    } else {
        console.error("Input element not found with ID:", "urlbox");
    }
}