function openRequestDemoModal(event) {
  event.preventDefault();
  const modalUrl = "https://www.ucertify.com/index.php?func=get_request_demo&page=";
  fetch(modalUrl)
    .then(response => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.text();
    })
    .then(html => {
      const modalContainer = document.createElement("div");
      modalContainer.innerHTML = html;
      document.body.appendChild(modalContainer);

      const modal = document.getElementById("instructor-evaluation-modal");
      if (modal) {
        modal.style.display = "block";
      }
    })
    .catch(error => {
      console.error("Error fetching modal content:", error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  const searchIcon = document.getElementById("searchIcon");
  const searchBox = document.querySelector(".search-box");
  const closeSearchBox = document.getElementById("closeSearchBox");
  const blogCategoryNav = document.querySelector(".blog-category-nav");
  const threeDotsDropdown = document.querySelector(".three-dots-dropdown");
  const searchContainer = document.querySelector(".search-container");

  // Function to show/hide elements
  function toggleElementsVisibility(hide) {
    if (hide) {
      blogCategoryNav.style.display = "none";
      threeDotsDropdown.style.display = "none";
      searchContainer.style.display = "none";
    } else {
      blogCategoryNav.style.display = "flex";
      threeDotsDropdown.style.display = "block";
      searchContainer.style.display = "block";
    }
  }

  // Toggle Search Box on Search Icon Click
  searchIcon.addEventListener("click", function () {
    searchBox.classList.remove("d-none");
    searchBox.classList.add("active");
    toggleElementsVisibility(true); // Hide elements
  });

  // Close Search Box on Close Button Click
  closeSearchBox.addEventListener("click", function () {
    searchBox.classList.add("d-none");
    searchBox.classList.remove("active");
    toggleElementsVisibility(false); // Show elements
  });

  // Close Search Box on ESC Key Press
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape" && searchBox.classList.contains("active")) {
      searchBox.classList.add("d-none");
      searchBox.classList.remove("active");
      toggleElementsVisibility(false); // Show elements
    }
  });

  // Close Search Box on Click Outside
  document.addEventListener("click", function (event) {
    if (
      !searchBox.contains(event.target) &&
      !searchIcon.contains(event.target) &&
      searchBox.classList.contains("active")
    ) {
      searchBox.classList.add("d-none");
      searchBox.classList.remove("active");
      toggleElementsVisibility(false); // Show elements
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Handle 3 dots dropdown for overflow categories
  const blogCategoryNav = document.querySelector(".blog-category-nav");
  const threeDotsDropdown = document.querySelector(".three-dots-dropdown");
  const dropdownMenu = threeDotsDropdown.querySelector(".dropdown-menu");

  function updateDropdown() {
    if (!blogCategoryNav || !threeDotsDropdown) return;

    const navItems = Array.from(blogCategoryNav.children);
    dropdownMenu.innerHTML = ""; // Clear existing dropdown items

    let availableWidth = blogCategoryNav.offsetWidth;
    let usedWidth = 0;
    let shouldShowDropdown = false;

    navItems.forEach((item) => {
      usedWidth += item.offsetWidth;

      if (usedWidth > availableWidth) {
        shouldShowDropdown = true;
        item.style.display = "none"; // Hide overflowing category

        const link = item.querySelector(".nav-link");
        const dropdownItem = document.createElement("li");
        dropdownItem.innerHTML = `<a class="dropdown-item" href="${link.href}">${link.textContent}</a>`;
        dropdownMenu.appendChild(dropdownItem);
      } else {
        item.style.display = ""; // Keep visible if within limits
      }
    });

    threeDotsDropdown.style.display = shouldShowDropdown ? "block" : "none";
  }

  // Call updateDropdown on load & window resize
  window.addEventListener("resize", updateDropdown);
  updateDropdown();
});

document.addEventListener("DOMContentLoaded", function () {
    const subscribeForms = document.querySelectorAll('.subscribeForm');
    const toastSuccess = new bootstrap.Toast(document.getElementById('subscriptionToastSuccess'));
    const toastError = new bootstrap.Toast(document.getElementById('subscriptionToastError'));
    const toastWarning = new bootstrap.Toast(document.getElementById('subscriptionToastWarning'));

    subscribeForms.forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const emailInput = form.querySelector('input[type="email"]');
            const subscribeBtn = form.querySelector('button[type="submit"]');
            const email = emailInput.value.trim();

            // Check if the email input is blank
            if (!email) {
                toastWarning.show();
                return;
            }

            // Show spinner on button
            subscribeBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Subscribing...`;
            subscribeBtn.disabled = true;

            // AJAX request to handle subscription
            fetch(uc_subscription_ajax.ajaxurl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'uc_subscribe',
                    nonce: uc_subscription_ajax.nonce,
                    email: email
                })
            })
            .then(response => response.json())
            .then(data => {
                // Reset button text based on form class
                subscribeBtn.innerHTML = form.classList.contains('sidebar-subscription-btn') ? 'Subscribe' : 'Subscribe *';
                subscribeBtn.disabled = false;

                if (data.success) {
                    if (data.data.already_subscribed) {
                        // Show warning toast for already subscribed with dynamic message
                        document.querySelector('#subscriptionToastWarning .toast-body').textContent = data.data.message;
                        toastWarning.show();
                    } else {
                        // Show success toast for new subscription with dynamic message
                        document.querySelector('#subscriptionToastSuccess .toast-body').textContent = data.data.message;
                        toastSuccess.show();
                        form.reset(); // Reset form only on new subscription success
                    }
                } else {
                    // Handle error or warning responses
                    if (data.data.type === 'warning') {
                        document.querySelector('#subscriptionToastWarning .toast-body').textContent = data.data.message;
                        toastWarning.show();
                    } else {
                        document.querySelector('#subscriptionToastError .toast-body').textContent = data.data.message;
                        toastError.show();
                    }
                }
            })
            .catch(error => {
                console.error('Subscription error:', error);
                subscribeBtn.innerHTML = form.classList.contains('sidebar-subscription-btn') ? 'Subscribe' : 'Subscribe *';
                subscribeBtn.disabled = false;
                document.querySelector('#subscriptionToastError .toast-body').textContent = 'An error occurred. Please try again.';
                toastError.show();
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const demoForm = document.getElementById('demo-form');
    
    // Form submission handling
    demoForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Check for validation
        if (!demoForm.checkValidity()) {
            event.stopPropagation();
            demoForm.classList.add('was-validated');
            return;
        }

        // If the form is valid, simulate a submission (AJAX call, etc.)
        // Show a success message or handle any actions here
        
        // Example: You can show a success toast
        alert("Demo Request Submitted Successfully!");
        
        // Reset form after submission
        demoForm.reset();
        demoForm.classList.remove('was-validated');
    });

    // For resetting validation if the modal is closed
    const modalCloseButton = document.querySelectorAll('.btn-close');
    modalCloseButton.forEach(button => {
        button.addEventListener('click', function() {
            demoForm.reset();
            demoForm.classList.remove('was-validated');
        });
    });
});

// This function simulates form submission handling.
function submitDemoRequest() {
    const demoForm = document.getElementById('demo-form');
    if (!demoForm.checkValidity()) {
        demoForm.classList.add('was-validated');
    } else {
        // Handle successful form submission
        alert("Form Submitted Successfully!");
    }
}


// Set the threshold (the point at which the class is added)
const threshold = 200;

// Get the element you want to add the class to
const navbar = document.querySelector('.blog-category-div');

// Add an event listener to the window's scroll event
window.addEventListener('scroll', () => {
  // Check if the scroll position is greater than or equal to the threshold
  if (window.scrollY >= threshold) {
    // Add the class 'navbar-stuck' when the scroll position is greater than or equal to the threshold
    navbar.classList.add('navbar-stuck');
  } else {
    // Remove the class 'navbar-stuck' when the scroll position is less than the threshold
    navbar.classList.remove('navbar-stuck');
  }
});

document.addEventListener("DOMContentLoaded", function () {
    const tocDiv = document.querySelector(".table-of-content-div");

    window.addEventListener("scroll", function () {
        if (window.innerWidth < 990) {
            if (window.scrollY >= 200) { // 3 points scroll ke liye 300px threshold set
                tocDiv.classList.add("navbar-stuck");
            } else {
                tocDiv.classList.remove("navbar-stuck");
            }
        } else {
            tocDiv.classList.remove("navbar-stuck"); // 990px se upar class hamesha hatai rahe
        }
    });
});

document.querySelectorAll('.table-of-contents a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            const headerHeight = document.querySelector('header').offsetHeight;
            const offsetValue = window.innerWidth < 991 ? 125 : 70;
            const offsetPosition = targetElement.getBoundingClientRect().top + window.scrollY - headerHeight - offsetValue;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });

            // Close the collapsible menu if the screen width is less than 991px
            if (window.innerWidth < 991) {
                const mobileToc = document.getElementById('mobileToc');
                if (mobileToc.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(mobileToc, {
                        toggle: true
                    });
                }
            }
        }
    });
});

// cookies & cache
document.addEventListener('DOMContentLoaded', function () {
    // Initialize toasts once
    const acceptToast = new bootstrap.Toast(document.getElementById('acceptToast'));
    const rejectToast = new bootstrap.Toast(document.getElementById('rejectToast'));

    // Check if user has already made a choice
    const cookieChoice = localStorage.getItem('cookieConsent');

    if (!cookieChoice) {
        const cookieModal = new bootstrap.Offcanvas(document.getElementById('cookieConsentModal'));
        cookieModal.show();
    }

    // Accept Cookies Button
    document.getElementById('acceptCookies').addEventListener('click', function () {
        localStorage.setItem('cookieConsent', 'accepted');
        bootstrap.Offcanvas.getInstance(document.getElementById('cookieConsentModal')).hide();
        acceptToast.show();
    });

    // Reject Cookies Button
    document.getElementById('rejectCookies').addEventListener('click', function () {
        localStorage.setItem('cookieConsent', 'rejected');
        bootstrap.Offcanvas.getInstance(document.getElementById('cookieConsentModal')).hide();
        rejectToast.show();
    });
});
// cookies & cache ends

// TTS Starts
document.addEventListener('DOMContentLoaded', () => {
    const ttsPlayBtn = document.querySelector('.tts-play-btn');
    const ttsVoiceOptions = document.querySelector('.tts-voice-options');
    const ttsMaleBtn = document.querySelector('.tts-voice-male');
    const ttsFemaleBtn = document.querySelector('.tts-voice-female');
    const ttsVolumeUpBtn = document.querySelector('.tts-volume-up');
    const ttsVolumeDownBtn = document.querySelector('.tts-volume-down');
    let isSpeaking = false;
    let utteranceQueue = [];
    let currentUtterance = null;
    let selectedVoice = null;
    let currentChunkIndex = 0;
    let isPaused = false;
    let currentVoiceGender = null;
    let currentVolume = 1.0;
    let fadeInterval = null;

    const postTitle = document.querySelector('h1.h3.fw-bold') ? document.querySelector('h1.h3.fw-bold').innerText : '';
    const readingTime = document.querySelector('.d-flex.align-items-center.me-3 span.fs-sm') ? document.querySelector('.d-flex.align-items-center.me-3 span.fs-sm').innerText : '';
    const authorName = document.querySelector('.d-flex.align-items-center.position-relative.mb-2 a.fw-semibold') ? document.querySelector('.d-flex.align-items-center.position-relative.mb-2 a.fw-semibold').innerText : '';
    const postContentElement = document.querySelector('.post-content');
    const postContent = postContentElement ? Array.from(postContentElement.querySelectorAll('p, h1, h2, h3, h4, h5, h6, li')).map(el => el.innerText).join(' ') : '';
    const articleContent = `${postTitle}. Reading time: ${readingTime}. Author: ${authorName}. ${postContent}`;

    const chunkSize = 2000;
    const contentChunks = [];
    for (let i = 0; i < articleContent.length; i += chunkSize) {
        contentChunks.push(articleContent.substring(i, i + chunkSize));
    }

    let voices = [];
    function populateVoices() {
        voices = speechSynthesis.getVoices();
        voices = voices.filter(voice => voice.lang.includes('en'));
        console.log('Available voices:', voices);
    }

    function initializeVoices() {
        populateVoices();
        if (voices.length === 0) {
            speechSynthesis.onvoiceschanged = () => {
                populateVoices();
                speechSynthesis.onvoiceschanged = null;
            };
        }
    }
    initializeVoices();

    // Fade volume effect
    function fadeVolume(targetVolume, duration = 1000) {
        clearInterval(fadeInterval);
        const startVolume = currentVolume;
        const steps = 20;
        const stepDuration = duration / steps;
        const volumeStep = (targetVolume - startVolume) / steps;
        let currentStep = 0;

        fadeInterval = setInterval(() => {
            currentStep++;
            currentVolume = startVolume + volumeStep * currentStep;
            if (currentUtterance) {
                speechSynthesis.cancel();
                currentUtterance.volume = currentVolume;
                speechSynthesis.speak(currentUtterance);
            }
            if (currentStep >= steps) {
                currentVolume = targetVolume;
                clearInterval(fadeInterval);
            }
        }, stepDuration);
    }

    // Mobile: Click to show voice options
    ttsPlayBtn.addEventListener('click', (e) => {
        if (window.innerWidth < 992) {
            ttsVoiceOptions.classList.toggle('d-none');
            if (isSpeaking || isPaused) {
                togglePauseResume();
            }
        } else {
            togglePauseResume();
        }
    });

    // Desktop: Hover to show voice options
    ttsPlayBtn.addEventListener('mouseenter', () => {
        if (window.innerWidth >= 992) {
            ttsVoiceOptions.classList.remove('d-none');
            ttsVoiceOptions.classList.add('d-flex', 'flex-column');
            if (isSpeaking || isPaused) {
                ttsVoiceOptions.querySelector('.tts-volume-controls').classList.remove('d-none');
            }
        }
    });
    ttsPlayBtn.addEventListener('mouseleave', () => {
        if (window.innerWidth >= 992) {
            setTimeout(() => {
                if (!ttsVoiceOptions.matches(':hover')) {
                    ttsVoiceOptions.classList.add('d-none');
                    ttsVoiceOptions.classList.remove('d-flex', 'flex-column');
                }
            }, 100);
        }
    });
    ttsVoiceOptions.addEventListener('mouseleave', () => {
        if (window.innerWidth >= 992) {
            ttsVoiceOptions.classList.add('d-none');
            ttsVoiceOptions.classList.remove('d-flex', 'flex-column');
        }
    });

    function speakArticle(voiceGender) {
        speechSynthesis.cancel();
        isSpeaking = false;
        isPaused = false;
        utteranceQueue = [];
        currentUtterance = null;
        currentChunkIndex = 0;
        currentVoiceGender = voiceGender;
        currentVolume = 0.1;
        ttsPlayBtn.querySelector('i').classList.replace('bx-pause', 'bx-play');
        ttsVoiceOptions.querySelector('.tts-volume-controls').classList.remove('d-none');

        if (voiceGender === 'male') {
            ttsMaleBtn.querySelector('i').classList.replace('bx-male', 'bx-stop');
            ttsFemaleBtn.querySelector('i').classList.replace('bx-stop', 'bx-female');
        } else {
            ttsFemaleBtn.querySelector('i').classList.replace('bx-female', 'bx-stop');
            ttsMaleBtn.querySelector('i').classList.replace('bx-stop', 'bx-male');
        }

        if (voices.length === 0) {
            console.warn('Voices not loaded yet, retrying...');
            setTimeout(() => speakArticle(voiceGender), 500);
            return;
        }

        const indianVoices = voices.filter(voice => voice.lang === 'en-IN');
        const generalVoices = voices.filter(voice => voice.lang.includes('en') && voice.lang !== 'en-IN');

        if (voiceGender === 'male') {
            selectedVoice = indianVoices.find(voice => 
                voice.name.toLowerCase().includes('male') || 
                voice.name.toLowerCase().includes('ravi') || 
                voice.name.toLowerCase().includes('prabhat')
            ) || generalVoices.find(voice => 
                voice.name.toLowerCase().includes('male') || 
                voice.name.toLowerCase().includes('david') || 
                voice.name.toLowerCase().includes('mark') || 
                voice.name.toLowerCase().includes('google uk english male')
            );
        } else {
            selectedVoice = indianVoices.find(voice => 
                voice.name.toLowerCase().includes('female') || 
                voice.name.toLowerCase().includes('neerja') || 
                voice.name.toLowerCase().includes('shruti')
            ) || generalVoices.find(voice => 
                voice.name.toLowerCase().includes('female') || 
                voice.name.toLowerCase().includes('zira') || 
                voice.name.toLowerCase().includes('google uk english female') || 
                voice.name.toLowerCase().includes('google us english')
            );
        }

        selectedVoice = selectedVoice || generalVoices[0] || voices[0];
        if (!selectedVoice) {
            console.error('No suitable voice found');
            return;
        }

        console.log(`Selected voice: ${selectedVoice.name} (${selectedVoice.lang})`);

        utteranceQueue = contentChunks.map(chunk => {
            const utterance = new SpeechSynthesisUtterance(chunk);
            utterance.voice = selectedVoice;
            utterance.rate = 1.0;
            utterance.pitch = 1.0;
            utterance.volume = currentVolume;
            utterance.onerror = (event) => {
                console.error('Utterance error:', event.error);
                if (currentChunkIndex < utteranceQueue.length) {
                    playNextChunk();
                } else {
                    resetTTS();
                }
            };
            return utterance;
        });

        currentChunkIndex = 0;
        playNextChunk();
        fadeVolume(1.0, 1000);
    }

    function playNextChunk() {
        if (currentChunkIndex < utteranceQueue.length) {
            currentUtterance = utteranceQueue[currentChunkIndex];
            currentUtterance.onend = () => {
                currentChunkIndex++;
                playNextChunk();
            };
            try {
                if (speechSynthesis.paused) {
                    speechSynthesis.resume();
                }
                currentUtterance.volume = currentVolume;
                speechSynthesis.speak(currentUtterance);
                isSpeaking = true;
                ttsPlayBtn.querySelector('i').classList.replace('bx-headphone', 'bx-pause');
            } catch (error) {
                console.error('Error starting speech:', error);
                setTimeout(() => playNextChunk(), 100);
            }
        } else {
            resetTTS();
        }
    }

    function togglePauseResume() {
        if (isSpeaking) {
            fadeVolume(0.1, 500);
            setTimeout(() => {
                speechSynthesis.pause();
                isSpeaking = false;
                isPaused = true;
                ttsPlayBtn.querySelector('i').classList.replace('bx-pause', 'bx-play');
            }, 500);
        } else if (isPaused) {
            speechSynthesis.resume();
            fadeVolume(1.0, 500);
            isSpeaking = true;
            isPaused = false;
            ttsPlayBtn.querySelector('i').classList.replace('bx-play', 'bx-pause');
        }
    }

    function resetTTS() {
        speechSynthesis.cancel();
        fadeVolume(0.0, 500);
        setTimeout(() => {
            isSpeaking = false;
            isPaused = false;
            utteranceQueue = [];
            currentUtterance = null;
            currentChunkIndex = 0;
            currentVoiceGender = null;
            currentVolume = 1.0;
            ttsPlayBtn.querySelector('i').classList.replace('bx-pause', 'bx-headphone');
            ttsPlayBtn.querySelector('i').classList.replace('bx-play', 'bx-headphone');
            ttsVoiceOptions.querySelector('.tts-volume-controls').classList.add('d-none');
            ttsMaleBtn.querySelector('i').classList.replace('bx-stop', 'bx-male');
            ttsFemaleBtn.querySelector('i').classList.replace('bx-stop', 'bx-female');
        }, 500);
    }

    // Volume control
    ttsVolumeUpBtn.addEventListener('click', () => {
        currentVolume = Math.min(currentVolume + 0.1, 1.0);
        if (currentUtterance) {
            speechSynthesis.cancel();
            currentUtterance.volume = currentVolume;
            speechSynthesis.speak(currentUtterance);
        }
        console.log(`Volume increased to: ${currentVolume}`);
    });

    ttsVolumeDownBtn.addEventListener('click', () => {
        currentVolume = Math.max(currentVolume - 0.1, 0.0);
        if (currentUtterance) {
            speechSynthesis.cancel();
            currentUtterance.volume = currentVolume;
            speechSynthesis.speak(currentUtterance);
        }
        console.log(`Volume decreased to: ${currentVolume}`);
    });

    ttsMaleBtn.addEventListener('click', () => {
        if (currentVoiceGender === 'male' && (isSpeaking || isPaused)) {
            resetTTS();
        } else {
            speakArticle('male');
        }
    });

    ttsFemaleBtn.addEventListener('click', () => {
        if (currentVoiceGender === 'female' && (isSpeaking || isPaused)) {
            resetTTS();
        } else {
            speakArticle('female');
        }
    });

    // Handle navigation
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'hidden' && isSpeaking) {
            fadeVolume(0.1, 500);
            setTimeout(() => {
                speechSynthesis.pause();
                isSpeaking = false;
                isPaused = true;
                ttsPlayBtn.querySelector('i').classList.replace('bx-pause', 'bx-play');
            }, 500);
        } else if (document.visibilityState === 'visible' && isPaused && currentUtterance && currentVoiceGender) {
            speechSynthesis.resume();
            fadeVolume(1.0, 500);
            isSpeaking = true;
            isPaused = false;
            ttsPlayBtn.querySelector('i').classList.replace('bx-play', 'bx-pause');
        }
    });

    window.addEventListener('beforeunload', () => {
        if (isSpeaking) {
            fadeVolume(0.0, 500);
            setTimeout(() => {
                speechSynthesis.pause();
                isPaused = true;
            }, 500);
        }
    });
});
// TTS Ends

// Single Page Switcher
document.addEventListener("DOMContentLoaded", function () {
  const toggles = [document.getElementById('theme-mode'), document.getElementById('theme-mode-mobile')];
  const root = document.documentElement;

  toggles.forEach(toggle => {
    if (toggle) {
      // Initialize toggle state from localStorage
      toggle.checked = window.localStorage.getItem('mode') === 'dark';

      // Add change event listener
      toggle.addEventListener('change', function () {
        if (this.checked) {
          root.classList.add('dark-mode');
          localStorage.setItem('mode', 'dark');
        } else {
          root.classList.remove('dark-mode');
          localStorage.setItem('mode', 'light');
        }

        // Sync both toggles
        toggles.forEach(t => {
          if (t && t !== this) t.checked = this.checked;
        });
      });
    }
  });
});
// Single Page Switcher Ends