import React from "react";
import Nav from "@/Components/Nav";

export default function AppLayout({ children }) {
    return (
        <div className="d-flex">
            {/* Navbar + Sidebar */}
            <Nav />

            {/* Page Content */}
            <div className="main-panel flex-grow-1">
                <div className="content-wrapper">{children}</div>
            </div>
        </div>
    );
}
