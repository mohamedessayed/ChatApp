import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import AppChat from "./AppChat";



createRoot(document.getElementById('root')).render(<StrictMode>
    <AppChat />
</StrictMode>)