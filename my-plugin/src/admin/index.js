import './index.css'; // Deine Styles
import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import { SettingsPage } from './components/SettingsPage';

domReady(() => {
    const adminContainer = document.getElementById('my-plugin-settings');

    if (adminContainer) {
        const root = createRoot(adminContainer);
        root.render(<SettingsPage />);
    }
});
