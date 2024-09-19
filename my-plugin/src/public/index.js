import './index.css';
import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import {TestPage} from "./components/TestPage";

domReady(() => {
    const frontendContainer = document.getElementById('my-plugin-frontend');

    if (frontendContainer) {
        const root = createRoot(frontendContainer);
        root.render(<TestPage/>);
    }
});
