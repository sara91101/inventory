import React from "react";

export default function Home({ user, message }) {
    return (
        <div>
            <h1>{message}</h1>
            {user && <p>Hello, {user.name}!</p>}
        </div>
    );
}
